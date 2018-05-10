<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>身份证照片生成器</title>
       <link href="//cdn.bootcss.com/FrozenUI/1.3.0/css/frozen.css" rel="stylesheet">
	   <script src="//cdn.bootcss.com/FrozenUI/1.3.0/lib/zepto.min.js"></script>
		<script src="//cdn.bootcss.com/FrozenUI/1.3.0/js/frozen.js"></script>
    </head>
<body ontouchstart="">
<header class="ui-header ui-header-positive ui-border-b"></header>
    <section class="ui-container">
        <section id="tab">
        	<div class="demo-item">
        		<div class="demo-block">
        			<div class="ui-tab">
        			    <ul class="ui-tab-nav ui-border-b">
							<li>批量身份证照片生成器(灰色彩色双份)</li>
        			    </ul>
        			    <ul class="ui-tab-content" style="width:300%">
							<li> <div class="ui-form ui-border-t">
							    <form action="/handExcel.php" method="post" enctype="multipart/form-data">
							        <div class="ui-form-item ui-border-b">
							            <label>上传excel</label>
							            <input type="file" name="file_path">
							            <a href="#" class="ui-icon-close"></a>
							        </div>
							        <div class="ui-notice-btn">
							       		<input type="submit" value="生成"  class="ui-btn-primary ui-btn-lg"/>
							    	</div>
							    </form>
							</div>
							</li>
        			    </ul>
        			</div>
        		</div>
        		<script class="demo-script"></script>
        	</div>
        </section>
    </section>
	<script src="//cdn.bootcss.com/FrozenUI/1.3.0/lib/zepto.min.js"></script>
	 <script src="//cdn.bootcss.com/FrozenUI/1.3.0/js/frozen.js"></script>
<script>
	(function (){
		var tab = new fz.Scroll('.ui-tab', {
			role: 'tab',
			autoplay: false,
			interval: 3000
		});
		/* 滑动开始前 */
		tab.on('beforeScrollStart', function(fromIndex, toIndex) {
			console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
		})
	})();
</script>
    </body>
</html>
