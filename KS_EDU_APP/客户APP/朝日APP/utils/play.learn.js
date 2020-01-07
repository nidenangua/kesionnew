import {SaveLearnProgress} from '@/api/course'
class PlayerLearn {
    constructor(params){
        this.init(params)
        setInterval(()=>{
          if(this.saveFlag){
              this.time += 1
              if(this.time >= 6){
                  this.save()
                  this.time = 0
              }
          }
      },1000)
    }
    init(params = {}){
      this.time = 0
      this.saveFlag = false
      this.params = params
      if(params.type == 2){
        this.currentTime = 1
        this.duration = 1
        this.save(1)
      }else{
        this.currentTime = 0
        this.duration = 0
      }
    }
    onplay(e){
        this.saveFlag = true
    }
    onpause(){
        this.saveFlag = false
        this.save(1)
    }
    ontimeupdate(e){
      this.currentTime = Math.round(e.detail.currentTime)
      this.duration = Math.round(e.detail.duration)
      if(this.params.audition > 0 && this.currentTime >= this.params.audition){
        if(typeof this.params.onAuditionEnded === 'function'){
          this.params.onAuditionEnded()
        }
      }
    }
    onended(){
        this.saveFlag = false
        this.save(1)
    }
    save(savetodb = 0){
      if(this.saveing){
        return
      }
      this.saveing = true
      SaveLearnProgress({
        courseid:this.params.courseid,
        pid:this.params.periodid,
        costype:this.params.costype,
        time:this.currentTime,
        totaltime:this.duration,
        savetodb
      }).then((msg)=>{
        this.saveing = false
        if(typeof this.params.onSaveCallback === 'onSaveCallback'){
          this.params.onSaveCallback(msg)
        }
      })
    }
    
}

export default PlayerLearn