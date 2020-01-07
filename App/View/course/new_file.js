
function nesting(){
		var $this = $(this);
		var tagName = parameter.tagName;
		var nestedName = parameter.nestedName.split(',');
		var loopNum = parameter.loopNum;
		var size = $this.find(tagName).size();
		var frequency = Math.ceil(size/loopNum);
		var nestedTag = nestedName[0];
		var nestedTagName = nestedName[1];
		var tagId = -1;
		$this.find(tagName).each(function(){
			tagId++;
			$(this).attr('tag-id',tagId);
		});
		
		if($.trim(nestedTagName)==''||!nestedTagName){
			var appendTag = '<'+nestedTag+' nesting></'+nestedTag+'>';
		}else{
			var appendTag = '<'+nestedTag+' class="'+nestedTagName+'" nesting></'+nestedTag+'>';
		};
		for(f=0;f<frequency;f++){
			$this.append(appendTag);
			
			for(s=f*loopNum;s<f*loopNum+loopNum;s++){
				
				$this.find(tagName+'[tag-id="'+s+'"]').appendTo($this.find('[nesting]').eq(f))
				
			};
		};
}
