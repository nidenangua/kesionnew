<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Demo</title>

<script src="/Public/common/js/jquery.js" type="text/javascript"></script>
<script src="/Public/common/js/aliyun/vod-sdk-upload-1.0.6.min.js" type="text/javascript"></script>
<script src="/Public/common/js/aliyun/aliyun-sdk.min.js" type="text/javascript"></script> 
	<style>
	.file {position: relative; width:80px;overflow: hidden;background:#b0b9bf;color: #fff;text-decoration: none;text-indent: 0;line-height: 34px;vertical-align: middle;margin-right: 10px;border-radius: 3px; text-align:center;}
    .file input {position: absolute;font-size: 100px;right: 0;top: 0;opacity: 0;}
    .file:hover {background: #13c0b1;}
	.topBtn{ margin-bottom:20px; margin-top:20px;}
	.jdt{ width:328px; height:8px; background:#f0f0f0; border-radius:10px;}
	.jdt .jdtinner{ background:#13c0b1; height:8px; border-radius:10px; position:relative;}
	.jd-data{ position:absolute; bottom:-22px;right:-10px;}
	</style>
</head>
<body>   
  
    <input type="hidden" id="uploadAuth" size="20" value="eyJTZWN1cml0eVRva2VuIjoiQ0FJU3NnUjFxNkZ0NUIyeWZTaklwNUxnQ00zeG5yVkNncnVxVGtlSWxURmdTZW9adnFEQnBEejJJSHBLZVhkdUFlQVhzL28wbW1oWjcvWVlsclVxRThjVkhoQ1lONVVnc2NvUHFGcndKcGZadjh1ODRZQURpNUNqUWVJY3ZOaFBuNTI4V2Y3d2FmK0FVSFBIQ1RtZDVLRVpvOWJUY1RHbFFDWVRXUC90b0pWN2I5TVJjeENsWkQ1ZGZybC9MUmRqcjhsb21CS3pVUEcyS1V6U24zYjNCa2hsc1JZZThtUms4dmFhMzhtQTZ3TFhsa0hIMHVzU3JvaVRVWisvZEp0Tk9wWmpVdDZwMGNscmNyYkF5Q2RLOXlWUzhLQi9nTTRpL2l6YzdPeUZCMTVZN3kyUEtmYTJpTnAwTjExRWZxdzlFcUo4cGVMZ3Z2cGdxNDZna0ovc21UMUtPUGxSWGpqU1laMmszTXJjRWZtMUM4NDljci8zV1FUS3ljdmRINVB5cVI4QmZIWUhOUnREWWNZY01udDNBQkJPT2piQk1mMkQrVXZXUnhxblY2bWQyYnNxN0lKeHlGems1cmp2SUVPVUVaR1l5am9nTTRVZ2REazhWWGdzMEhmbWI3VU5maUZWYmxwakhNejFkNGhvYXcxRW9xNmF0Vy9rWHlaN25IWk1wSys4TmJHRXU2WmFNOTJtQWNvWWk5VkVOTThZNnpad0h3V3lHK3lyMUY0VUpIQnVSUEZJMGFYZ1B0ampzT0hlbThuT1RhdWZWOXdzNTN3REtXMks5Ry9VRVNzQWFIYXR1b2RtTndySHZwcUpsZldkdFpaNFRDbFd2NEFBVmwvYUlZczE4UVU4di9QdnNDNytxckd6RGlxWW1VTWo0Y1RkOG9WMTdrOXBRK3lwbWVmNnZFU0Y1aUxOUC9kaHlKYUtCall4R1VYdUt5Wmp2Tm1XaDJNYW9TNEduMXE5TWcwazkwK3IwbUs5YkR5MUpUcC9MYkV2R29BQmo3S2xvMVd0K3preGxYL0lmN25ZT1lVdGMwakhIankzSlZHSVRiWExmNExkcnJSbXJHUThNci9HUjRORG5hb08yWXU4MHc1em14dGxKb0hOcTlmK1JIRFZ6WW9BRlI2MUwva3JrUkoxRXk3TDFOdjBuSlN1S1FxTVFKaW9rSWNIeGhZSXZkWkZNTUNoT2w3OTRkR083cWFEMStwNTI1aXRmUFFKcWNMOVdyZz0iLCJBY2Nlc3NLZXlJZCI6IlNUUy5GUVVDd0VzamM1eUFMYTlxMTVFZTVRZWpGIiwiQWNjZXNzS2V5U2VjcmV0IjoiQXhtSnZLS0dFS1JBU0NvYlN6VkRwajFMUkZadmNleFhGaWFRaUtVdlBtdkwiLCJFeHBpcmF0aW9uIjoiMzYwMCJ9">         
    <input type="hidden" id="uploadAddress" size="20" value="eyJFbmRwb2ludCI6Imh0dHBzOi8vb3NzLWNuLXNoYW5naGFpLmFsaXl1bmNzLmNvbSIsIkJ1Y2tldCI6ImluLTIwMTcwNjI3MTgzNjA1Mjg5LTg2bTZxaDh0Y20iLCJGaWxlTmFtZSI6InZpZGVvLzQwNjMzRDVELTE1REM1QTEwNTMzLTEwMDgtMzQ0Mi02ODctNjAxMTkubXA0In0=">
    <input type="hidden" id="accessKeyId" size="20" value="">
    <input type="hidden" id="accessKeySecret" size="40" value="">
    <input type="hidden" id="secretToken" size="40" value="">          
    <input type="hidden" id="expireTime" size="20" value="">     
    <input type="hidden" id="endpoint" size="40" value="http://oss-cn-hangzhou.aliyuncs.com">           
    <input type="hidden" id="bucket" size="20" value="testbucket">       
    <input type="hidden" id="objectPre" size="20" value="uploadtest/">
    <input type="hidden" id="vid" size="60" value="1111">
	
	<div class="clearfix topBtn">
		<div class="fl file"><input type="file" name="file" id="files" multiple/>点击上传</div><div class="tips" style="margin-top:30px;">上传的文件为.mp4,.flv,.avi,.mp3格式</div>
		<button type="button" onClick="startabc()" class="fl button">开始上传</button>		
    </div>
	<div class="jdt" id="jid" style="display:none"><div class="jdtinner" style="width:0%;"><div class="jd-data">0%</div></div></div>

	
    <select multiple="multiple" id="textarea" style="position:relative; width:100%; height:100px; vertical-align:top; border:1px solid #cccccc;display:none"></select>
	
	<!--<div style="margin-top:20px;">
        <button type="button" onClick="clearLog()" class="button">清日志</button>
    </div>-->
	
<script>

   var uploader;

   
       window.onload = new function () {
        if (document.getElementById("files").files == undefined) {
            alert("该上传需要IE9及以上浏览器");
        }
        uploader = new VODUpload({
            // 文件上传失败
            'onUploadFailed': function (uploadInfo, code, message) {
                log("onUploadFailed: file:" + uploadInfo.file.name + ",code:" + code + ", message:" + message);
            },
            // 文件上传完成
            'onUploadSucceed': function (uploadInfo) {
                var vid = jQuery("#vid").val();
                var files = document.getElementById("files").files;
                jQuery("#jid").hide();
                $.ajax({
                    url: "/Plus/course/AddYunVideos.aspx?from=pc&action=getadd&VideoType=10&vid=" + vid + "&title=" + files[0].name + "&status=1&filesize=" + files[0].size +  "&rnd=" + Math.random(),
                      context: document.body,
                      type: "get",
                      success: function (data) {
                          if (data == 'ok') {
                              if (top.frames['main'].box1 == undefined) {
                                  $('#TextAddress', window.parent.document).val(vid);
                                  top.box1.close();
                              } else {
                                  $(top.frames["main"].document.getElementById("TextAddress")).val(vid);
                                  top.frames['main'].box1.close();
                              }
                             
                          }
                          else if (data == 'have') {
                           top.alert("抱歉，添加视频已经上限啦");
                          }
                      }
                  });


               // log("onUploadSucceed: " + uploadInfo.file.name + ", endpoint:" + uploadInfo.endpoint + ", bucket:" + uploadInfo.bucket + ", object:" + uploadInfo.object);
            },
            // 文件上传进度			

            'onUploadProgress': function (uploadInfo, totalSize, uploadedSize) {

                document.getElementById("jid").innerHTML = '<div class="jdtinner" style="width:'+ Math.ceil(uploadedSize * 100 / totalSize) +'%;"><div class="jd-data">' + Math.ceil(uploadedSize * 100 / totalSize) + '%</div></div>';
               // log("onUploadProgress:file:" + uploadInfo.file.name + ", fileSize:" + totalSize + ", percent:" + Math.ceil(uploadedSize * 100 / totalSize) + "%");
            },
            // STS临时账号会过期，过期时触发函数
            'onUploadTokenExpired': function () {
                log("onUploadTokenExpired");
                if (isVodMode()) {
                    // 实现时，从新获取UploadAuth
                    // uploader.resumeUploadWithAuth(uploadAuth);
                } else if (isSTSMode()) {
                    // 实现时，从新获取STS临时账号用于恢复上传
                    // uploader.resumeUploadWithToken(accessKeyId, accessKeySecret, secretToken, expireTime);
                }
            },
            // 开始上传
            'onUploadstarted': function (uploadInfo) {
                jQuery("#jid").show();
                jQuery("#textarea").hide();
                
                if (isVodMode()) {
                    var uploadAuth = document.getElementById("uploadAuth").value;
                    var uploadAddress = document.getElementById("uploadAddress").value;
                    uploader.setUploadAuthAndAddress(uploadInfo, uploadAuth, uploadAddress);
                }
                log("onUploadStarted:" + uploadInfo.file.name + ", endpoint:" + uploadInfo.endpoint + ", bucket:" + uploadInfo.bucket + ", object:" + uploadInfo.object);
            }
        });

        var accessKeyId = document.getElementById("accessKeyId").value;
        var accessKeySecret = document.getElementById("accessKeySecret").value;
        var secretToken = document.getElementById("secretToken").value;
        var expireTime = document.getElementById("expireTime").value;

        if (isVodMode()) {
            // 点播上传。每次上传都是独立的鉴权，所以初始化时，不需要设置鉴权
            uploader.init();
        } else if (isSTSMode()) {
            // OSS直接上传:STS方式，安全但是较为复杂，建议生产环境下使用。
            // 临时账号过期时，在onUploadTokenExpired事件中，用resumeWithToken更新临时账号，上传会续传。
            uploader.init(accessKeyId, accessKeySecret, secretToken, expireTime);
        } else {
            // OSS直接上传:AK方式，简单但是不够安全，建议测试环境下使用。
            uploader.init(accessKeyId, accessKeySecret);
        }
    };

    document.getElementById("files")
        .addEventListener('change', function (event) {
            var endpoint = document.getElementById("endpoint").value;
            var bucket = document.getElementById("bucket").value;
            var objectPre = document.getElementById("objectPre").value;
            var userData;
            if (isVodMode()) {
                userData = '{"Vod":{"UserData":"{"IsShowWaterMark":"false","Priority":"7"}"}}';
            } else {
                userData = '{"Vod":{"Title":"this is title.我是标题","Description":"this is desc.我是描述","CateId":"19",\
                "Tags":"tag1,tag2,标签3","UserData":"user data"}}';
            }

            for (var i = 0; i < event.target.files.length; i++) {
                //   log("add file: " + event.target.files[i].name);

                if (isVodMode()) {
                    // 点播上传。每次上传都是独立的OSS object，所以添加文件时，不需要设置OSS的属性
                    uploader.addFile(event.target.files[i], null, null, null, userData);
                } else {
                    uploader.addFile(event.target.files[i], endpoint, bucket, objectPre + event.target.files[i].name, userData);
                }

            }
         setTimeout("startabc()",500);
        });
    
    var textarea = document.getElementById("textarea");

    function start() {
        log("start upload.");
        uploader.startUpload();
    }

    function stop() {
        log("stop upload.");
        uploader.stopUpload();
    }

    function resumeWithToken() {
        log("resume upload with token.");
        var uploadAuth = document.getElementById("uploadAuth").value;

        var accessKeyId = document.getElementById("accessKeyId").value;
        var accessKeySecret = document.getElementById("accessKeySecret").value;
        var secretToken = document.getElementById("secretToken").value;
        var expireTime = document.getElementById("expireTime").value;

        if (isVodMode()) {
            uploader.resumeUploadWithAuth(uploadAuth);
        } else if (isSTSMode()) {
            uploader.resumeUploadWithToken(accessKeyId, accessKeySecret, secretToken, expireTime);
        }
    }

    function clearList() {
        log("clean upload list.");
        uploader.cleanList();
    }
   
    function getList() {
        log("get upload list.");
        var list = uploader.listFiles();
        for (var i = 0; i < list.length; i++) {
            log("file:" + list[i].file.name + ", status:" + list[i].state + ", endpoint:" + list[i].endpoint + ", bucket:" + list[i].bucket + ", object:" + list[i].object);
        }
    }

    function deleteFile() {
        if (document.getElementById("deleteIndex").value) {
            var index = document.getElementById("deleteIndex").value
            log("delete file index:" + index);
            uploader.deleteFile(index);
        }
    }

    function cancelFile() {
        if (document.getElementById("cancelIndex").value) {
            var index = document.getElementById("cancelIndex").value
            log("cancel file index:" + index);
            uploader.cancelFile(index);
        }
    }

    function resumeFile() {
        if (document.getElementById("resumeIndex").value) {
            var index = document.getElementById("resumeIndex").value
            log("resume file index:" + index);
            uploader.resumeFile(index);
        }
    }

    function clearLog() {
        textarea.options.length = 0;
    }

    function log(value) {
        if (!value) {
            return;
        }

        var len = textarea.options.length;
        if (len > 0 && textarea.options[len - 1].value.substring(0, 40) == value.substring(0, 40)) {
            textarea.remove(len - 1);
        } else if (len > 25) {
            textarea.remove(0);
        }

        var option = document.createElement("option");
        option.value = value, option.innerHTML = value;
        textarea.appendChild(option);
    }

    function isVodMode() {
        var uploadAuth = document.getElementById("uploadAuth").value;
        return (uploadAuth && uploadAuth.length > 0);
    }

    function isSTSMode() {
        var secretToken = document.getElementById("secretToken").value;
        var expireTime = document.getElementById("expireTime").value;
        if (!isVodMode()) {
            if (secretToken && secretToken.length > 0 && expireTime && expireTime.length > 0) {
                return true;
            }
        }
        return false;
    }

</script>

</body>
</html>
