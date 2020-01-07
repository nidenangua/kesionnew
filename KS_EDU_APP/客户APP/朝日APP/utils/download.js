import {DownLoadCourse} from 'api/down'
let AllTasks = []
function getPlus(){
	return new Promise(resolve=>{
		if(typeof plus === 'object'){
			resolve(plus)
		}else{
			setTimeout(()=>{
				getPlus().then(plus=>{
					resolve(plus)
				})
			},100)
		}
	})
}

const Download = new Object()

/*
 * 处理图片地址
 */
Download.handlerSrc = function(src){
	switch(src.indexOf('//')){
		case 0:
		case 5:
		case 6:
			return src
			break
		default:
			return this.baseUrl + src
	}
}

/**
 * 数据初始化
 */
Download.init = function(options){
	this.baseUrl = options.baseUrl || ''
	this.userid = options.userid
	this.courseid = options.courseid
	options.periodids = options.periodids || ''
	this.periodids = options.periodids.split(',')
	this.onChange = options.onChange
	this.getCachTxt()
}
/**
 * 获取缓存记录文件
 */
Download.getCachTxt = function(){
	getPlus().then(plus=>{
		/*查找记录缓存信息的文件*/
		plus.io.resolveLocalFileSystemURL(`_doc/cache/${this.userid}.txt`, (entry)=> {
			let reader = new plus.io.FileReader()
			reader.readAsText(entry)
			reader.onloadend = (e)=> {
				if(!AllTasks.length){
					AllTasks = JSON.parse(e.target.result)	
				}
				/**枚举下载任务*/
				plus.downloader.enumerate((tasks)=>{
					if(tasks.length){

						AllTasks.map(courseItem=>{
							if(this.courseid == courseItem.courseid){
								courseItem.taskList.map(item=>{
									let has = false
									tasks.map(t=>{
										/*根据filename 获取periodid*/
										let periodid = t.options.filename.split('/')
										periodid = periodid[periodid.length-1].replace(/\..+/,'')
										if(periodid == item.periodid){
											if(has){
												/*回收无用下载任务*/
												t.abort()
											}else{
												if(item.state == 4){
													t.abort()
												}else{
													this.bindTaskEvent(item,t)
													item.state = t.state
													item.totalSize = (t.totalSize/1000000).toFixed(1)
													item.downloadedSize = (t.downloadedSize/1000000).toFixed(1)
													item.percent = Math.floor((t.downloadedSize/t.totalSize)*100)
													item.task = t
												}
												has = true
											}
											
										}
									})
									/*对要下载的课时进行去重*/
									this.periodids.map((pid,i)=>{
										if(pid == item.periodid){
											this.periodids.splice(i,1)
										}
									})
								})
							}
						})
					}
					this.createTask()
				})
			}
		}, (e)=> {
			/*没有找到,说明未缓存过*/
			this.createTask()
			console.log(e.message)
		})	
	})
}
/**
 * 创建任务
 */
Download.createTask = function(){
	DownLoadCourse({
		courseid:this.courseid,
		periodids:this.periodids
	}).then(res=>{
		if(!res.result){
			uni.showToast({
			    title: res.msg,
			    icon: 'none'
			})
			return
		}
		res.data = res.data || []
		res.data.map(item=>{
			item.state = undefined
			item.totalSize = 0
			item.downloadedSize = 0
			item.percent = 0
		})
		let currentCourseTask
		AllTasks.map(item=>{
			if(item.courseid == this.courseid){
				currentCourseTask = item
			}
		})
		if(!currentCourseTask){
			AllTasks.unshift({
				courseid:res.courseid,
				coursename:res.coursename,
				taskList:[]
			})
			currentCourseTask = AllTasks[0]
		}
		this.currentCourseTask = currentCourseTask
		currentCourseTask.taskList = res.data.concat(currentCourseTask.taskList)
		/*检查课程封面图片是否已下载*/
		if(!currentCourseTask.imageUrl){
			let courseImage = this.handlerSrc(res.photourl)
			/*下载课程图片*/
			var imageTask = plus.downloader.createDownload(courseImage, {
					filename: `_doc/video/${this.userid}/${this.courseid}/${this.courseid}.jpg`
				}, (d, status)=>{
					if(status == 200){ 	
						console.log('下载课程图片成功')
						let fileSysUrl = plus.io.convertLocalFileSystemURL(`_doc/video/${this.userid}/${this.courseid}/${this.courseid}.jpg`)
						currentCourseTask.imageUrl = `file://${fileSysUrl}` 
						this.writeFileJson()
					} else {
						 console.log('下载课程图片失败')
					}  	
			})
			imageTask.start()
		}
		currentCourseTask.taskList.map(item=>{
			if(!item.task){
				let task = plus.downloader.createDownload(item.download1, {
					filename: `_doc/video/${this.userid}/${this.courseid}/${item.periodid}/${item.periodid}.mp4`
				}, (d, status)=>{
					if(status == 200){ 	
						console.log('下载成功')
						
					} else {
						 console.log('下载失败'); 
					}  	
				})
				/*添加监听事件*/
				this.bindTaskEvent(item,task)
				task.start()
				item.task = task
			}
		})
		this.callback()
		
		/*判断是否有未完成的任务,如果有则启用定时器*/
		let uncompleted = currentCourseTask.taskList.filter(item=>{
			return item.state != 4
		})
		if(uncompleted.length){
			this.timer = setInterval(()=>{
				this.callback()
			},1000)
		}
		
	})
}

/**
 * 下载任务进度变化
 */
Download.bindTaskEvent = function(item,task){
	task.addEventListener("statechanged", (download, status)=>{
		item.state = download.state
		item.totalSize = (download.totalSize/1000000).toFixed(1)
		item.downloadedSize = (download.downloadedSize/1000000).toFixed(1)
		item.percent = Math.floor((download.downloadedSize/download.totalSize)*100)	
		if(item.state == 4 && status == 200){
			this.writeFileJson()
			this.clearTimer()
			
		}
	},false)
}

/**
 * 下载暂停
 */	
Download.pause = function(periodid){
	this.currentCourseTask.taskList.map(item=>{
		if(item.periodid == periodid && typeof item.task.pause === 'function'){
			item.task.pause()
			item.state = 5
			this.callback()
			this.writeFileJson()
			console.log('任务暂停')
		}
	})
}

/**
 * 全部暂停
 */	
Download.pauseAll = function(){
	this.currentCourseTask.taskList.map(item=>{
		if(typeof item.task.pause === 'function'){
			item.task.pause()
			item.state = 5
		}
	})
	this.writeFileJson()
	this.callback()
	console.log('全部暂停')
}

/**
 * 恢复下载
 */	
Download.resume = function(periodid){
	this.currentCourseTask.taskList.map(item=>{
		if(item.periodid == periodid && typeof item.task.resume === 'function'){
			item.task.resume()
			item.state = 3
			this.callback()
			console.log('继续下载')
		}
	})
}

/**
 * 全部恢复下载
 */
	
Download.resumeAll = function(){
	this.currentCourseTask.taskList.map(item=>{
		if(typeof item.task.resume === 'function'){
			item.task.resume()
			item.state = 3
		}
	})
	this.callback()
	console.log('全部开始')
}


/**
 * 清除定时器
 */
Download.clearTimer = function(){
	let uncompleted = this.currentCourseTask.taskList.filter(item=>{
		return item.state != 4
	})
	if(!uncompleted.length){
		plus.downloader.clear()
		/*已下载完成,清除定时器*/
		clearInterval(this.timer)
		this.callback()
	}
}

/**
 * 将json写入文件
 */
Download.writeFileJson = function() {
	plus.io.requestFileSystem(plus.io.PRIVATE_DOC, (success)=> {
		success.root.getFile(`cache/${this.userid}.txt`, {      
			create: true
		}, (fileEntry)=> {
			fileEntry.createWriter((suc)=> {
				suc.write(JSON.stringify(AllTasks))
				console.log('写入成功')
			}, (e)=> {
				console.log('写入失败,' + e.message) 
			})				
		})
	}, (e)=> {
		//失败的回调
	})
},	

/**
 * 递归删除任务以及已下载文件
 */
Download.removeTask = function(periodids,index = 0){
	return new Promise(resolve=>{
		let periodid = periodids[index]
		if(!periodid){
			this.callback()
			this.writeFileJson()
			resolve()
			return
		}
		let hander = ()=>{
			AllTasks.map(cositem=>{
				if(cositem.courseid == this.courseid){
					let _taskList = []
					cositem.taskList.map(item=>{
						if(item.periodid == periodid){
							if(item.task && item.task.state != 4 && typeof item.task.abort === 'function'){
								item.task.abort()
							}
						}else{
							_taskList.push(item)
						}
					})
					cositem.taskList = _taskList
					this.clearTimer()
				}
			})
			this.removeTask(periodids,index+1).then(()=>{
				resolve()
			})
		}
		
		/*查找文件*/
		plus.io.resolveLocalFileSystemURL(`_doc/video/${this.userid}/${this.courseid}/${periodid}/`, (entry)=> {
			/*删除文件*/
			entry.removeRecursively(res=>{
				console.log('删除成功')
				hander()
			},(e)=>{
				console.log( e.message );
			} );
		}, (e)=> {
			hander()
			console.log(e.message)
		})		
	})
	
}

/**
 * 数据回调
 */

Download.callback = function(){
	if(typeof this.onChange === 'function'){
		
		let data = {
			completedLength:0,
			pausesLength:0,
			downLength:0,
			coursename:this.currentCourseTask.coursename,
			taskList:[]
		}
		this.currentCourseTask.taskList.map(item=>{
			if(item.state == 4){
				data.completedLength += 1
			}else if(item.state == 5){
				data.pausesLength += 1
			}else{
				data.downLength += 1
			}
			data.taskList.push({
				filename:item.task ? item.task.filename : '',
				periodid:item.periodid,
				periodname:item.periodname,
				percent:item.percent,
				downloadedSize:item.downloadedSize,
				totalSize:item.totalSize,
				state:item.state
			})
		})
		this.onChange(data)
	}
	
}

/**
 * 可在页面卸载的时候执行
 */
Download.destroyed = function(){
	clearInterval(this.timer)
}


export default Download