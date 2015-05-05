<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title>item content view</title>

	<link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/docs.min.css" rel="stylesheet">
</head>
<body >
<header class="navbar navbar-default navbar-fixed-top" role="banner" >
<div class="container">
		<div class="navbar-header">
			 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
				<a class="navbar-brand" href="<?php echo site_url()?>">Brand</a>
		</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse" id="bs-example-navbar-collapse-2">
			  <ul class="nav navbar-nav">
					<?php
					   foreach($cat->result() as $row){
							$is_current = '';
							if(!empty($cat_slug) && $row->cat_slug == $cat_slug){
								$is_current = 'active';
							}
						   echo '<li role="presentation" class="'.$is_current.'"><a href="'.site_url('cat/'.rawurlencode($row->cat_slug)).'">'.$row->cat_name.'</a></li>';
						}
					 ?>
			  </ul>
			  <form class="navbar-form navbar-right" role="search">
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">搜索</button>
			  </form>
			</nav>
			
		
</div>
</header>
<div class="bs-docs-header"  style="padding-top:70px;display:none;">
	<div class="container">
		<h1>zujian</h1>
		<p>here is zujian</p>	
	</div>
</div>
<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-1" role="complementary">
			<ul class="nav nav-pills nav-stacked text-center hidden-print hidden-xs hidden-sm">
			  <li role="presentation" class="active"><a href="#" >健康</a></li>
			  <li role="presentation"><a href="#">绅士</a></li>
			  <li role="presentation"><a href="#">达人</a></li>
			</ul>
		</div>
		
		
		<div class="col-md-9" role="main">
  <h1 id="glyphicons" class="page-header">Glyphicons 字体图标</h1>

  <h2 id="glyphicons-glyphs">所有可用的图标</h2>
  <p>包括260个来自 Glyphicon Halflings 的字体图标。<a href="http://glyphicons.com/">Glyphicons</a> Halflings 一般是收费的，但是他们的作者允许 Bootstrap 免费使用。为了表示感谢，希望你在使用时尽量为 <a href="http://glyphicons.com/">Glyphicons</a> 添加一个友情链接。</p>
  <div class="bs-glyphicons">
    <ul class="bs-glyphicons-list">
      
        <li>
          <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-asterisk</span>
        </li>
      
        <li>
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-plus</span>
        </li>
      
        <li>
          <span class="glyphicon glyphicon-euro" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-euro</span>
        </li>
      
        <li>
          <span class="glyphicon glyphicon-eur" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-eur</span>
        </li>
      
        <li>
          <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-minus</span>
        </li>
      
        <li>
          <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-cloud</span>
        </li>
      
        <li>
          <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-envelope</span>
        </li>
      
        <li>
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          <span class="glyphicon-class">glyphicon glyphicon-pencil</span>
        </li>
    </ul>
  </div>


  <h2 id="glyphicons-how-to-use">如何使用</h2>
  <p>出于性能的考虑，所有图标都需要一个基类和对应每个图标的类。把下面的代码放在任何地方都可以正常使用。注意，为了设置正确的内补（padding），务必在图标和文本之间添加一个空格。</p>
  <div class="bs-callout bs-callout-danger" id="callout-glyphicons-dont-mix">
    <h4>不要和其他组件混合使用</h4>
    <p>图标类不能和其它组件直接联合使用。它们不能在同一个元素上与其他类共同存在。应该创建一个嵌套的 <code>&lt;span&gt;</code> 标签，并将图标类应用到这个 <code>&lt;span&gt;</code> 标签上。</p>
  </div>
  <div class="bs-callout bs-callout-danger" id="callout-glyphicons-empty-only">
    <h4>只对内容为空的元素起作用</h4>
    <p>图标类只能应用在不包含任何文本内容或子元素的元素上。</p>
  </div>
  <div class="bs-callout bs-callout-info" id="callout-glyphicons-location">
    <h4>改变图标字体文件的位置</h4>
    <p>Bootstrap 假定所有的图标字体文件全部位于 <code>../fonts/</code> 目录内，相对于预编译版 CSS 文件的目录。如果你修改了图标字体文件的位置，那么，你需要通过下面列出的任何一种方式来更新 CSS 文件：</p>
    <ul>
      <li>在 Less 源码文件中修改 <code>@icon-font-path</code> 和/或 <code>@icon-font-name</code> 变量。</li>
      <li>利用 Less 编译器提供的 <a href="http://lesscss.org/usage/#command-line-usage-relative-urls">相对 URL 地址选项</a>。</li>
      <li>修改预编译 CSS 文件中的 <code>url()</code> 地址。</li>
    </ul>
    <p>根据你自身的情况选择一种方式即可。</p>
  </div>
  <div class="bs-callout bs-callout-warning" id="callout-glyphicons-accessibility">
    <h4>图标的可访问性</h4>
    <p>现代的辅助技术能够识别并朗读由 CSS 生成的内容和特定的 Unicode 字符。为了避免 屏幕识读设备抓取非故意的和可能产生混淆的输出内容（尤其是当图标纯粹作为装饰用途时），我们为这些图标设置了 <code>aria-hidden="true"</code> 属性。</p>
    <p>如果你使用图标是为了表达某些含义（不仅仅是为了装饰用），请确保你所要表达的意思能够通过被辅助设备识别，例如，包含额外的内容并通过 <code>.sr-only</code> 类让其在视觉上表现出隐藏的效果。</p>
    <p>如果你所创建的组件不包含任何文本内容（例如， <code>&lt;button&gt;</code> 内只包含了一个图标），你应当提供其他的内容来表示这个控件的意图，这样就能让使用辅助设备的用户知道其作用了。这种情况下，你可以为控件添加 <code>aria-label</code> 属相。</p>
  </div>
<div class="highlight"><pre><code class="language-html" data-lang="html"><span class="nt">&lt;span</span> <span class="na">class=</span><span class="s">"glyphicon glyphicon-search"</span> <span class="na">aria-hidden=</span><span class="s">"true"</span><span class="nt">&gt;&lt;/span&gt;</span></code></pre></div>


  <h2 id="glyphicons-examples">实例</h2>
  <p>可以把它们应用到按钮、工具条中的按钮组、导航或输入框等地方。</p>
  <div class="bs-example" data-example-id="glyphicons-general">
    <div class="btn-toolbar" role="toolbar">
      <div class="btn-group">
        <button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></button>
        <button type="button" class="btn btn-default" aria-label="Center Align"><span class="glyphicon glyphicon-align-center" aria-hidden="true"></span></button>
        <button type="button" class="btn btn-default" aria-label="Right Align"><span class="glyphicon glyphicon-align-right" aria-hidden="true"></span></button>
        <button type="button" class="btn btn-default" aria-label="Justify"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></button>
      </div>
    </div>
    <div class="btn-toolbar" role="toolbar">
      <button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Star</button>
      <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Star</button>
      <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Star</button>
      <button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Star</button>
    </div>
  </div>
<div class="highlight"><pre><code class="language-html" data-lang="html"><span class="nt">&lt;button</span> <span class="na">type=</span><span class="s">"button"</span> <span class="na">class=</span><span class="s">"btn btn-default"</span> <span class="na">aria-label=</span><span class="s">"Left Align"</span><span class="nt">&gt;</span>
  <span class="nt">&lt;span</span> <span class="na">class=</span><span class="s">"glyphicon glyphicon-align-left"</span> <span class="na">aria-hidden=</span><span class="s">"true"</span><span class="nt">&gt;&lt;/span&gt;</span>
<span class="nt">&lt;/button&gt;</span>

<span class="nt">&lt;button</span> <span class="na">type=</span><span class="s">"button"</span> <span class="na">class=</span><span class="s">"btn btn-default btn-lg"</span><span class="nt">&gt;</span>
  <span class="nt">&lt;span</span> <span class="na">class=</span><span class="s">"glyphicon glyphicon-star"</span> <span class="na">aria-hidden=</span><span class="s">"true"</span><span class="nt">&gt;&lt;/span&gt;</span> Star
<span class="nt">&lt;/button&gt;</span></code></pre></div>
  <p><a href="#alerts">alert</a> 组件中所包含的图标是用来表示这是一条错误消息的，通过添加额外的 <code>.sr-only</code> 文本就可以让辅助设备知道这条提示所要表达的意思了。</p>
  <div class="bs-example" data-example-id="glyphicons-accessibility">
    <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      Enter a valid email address
    </div>
  </div>
<div class="highlight"><pre><code class="language-html" data-lang="html"><span class="nt">&lt;div</span> <span class="na">class=</span><span class="s">"alert alert-danger"</span> <span class="na">role=</span><span class="s">"alert"</span><span class="nt">&gt;</span>
  <span class="nt">&lt;span</span> <span class="na">class=</span><span class="s">"glyphicon glyphicon-exclamation-sign"</span> <span class="na">aria-hidden=</span><span class="s">"true"</span><span class="nt">&gt;&lt;/span&gt;</span>
  <span class="nt">&lt;span</span> <span class="na">class=</span><span class="s">"sr-only"</span><span class="nt">&gt;</span>Error:<span class="nt">&lt;/span&gt;</span>
  Enter a valid email address
<span class="nt">&lt;/div&gt;</span></code></pre></div>


<div class="media bs-callout-right bs-callout-info-right">
      <div class="media-left">
        <a href="#">
          <img class="media-object" data-src="holder.js/200x200" alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">Media heading</h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
</div>

<div class="media bs-callout-right bs-callout-info-right">
      <div class="media-left">
        <a href="#">
          <img class="media-object" data-src="holder.js/128x128" alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">Media heading</h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
</div>

<div class="media bs-callout-right bs-callout-info-right">
      <div class="media-left">
        <a href="#">
          <img class="media-object" data-src="holder.js/128x128" alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">Media heading</h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
</div>

<div class="media bs-callout-right bs-callout-info-right">
      <div class="media-left">
        <a href="#">
          <img class="media-object" data-src="holder.js/128x128" alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">Media heading</h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
</div>

<div class="media bs-callout-right bs-callout-info-right">
      <div class="media-left">
        <a href="#">
          <img class="media-object" data-src="holder.js/128x128" alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">Media heading</h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
</div>


<nav>
  <ul class="pagination">
    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
    <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
    <li><a href="#">4 <span class="sr-only">(current)</span></a></li>
    <li><a href="#">5 <span class="sr-only">(current)</span></a></li>
     <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

</div>




<div class="col-md-2" role="complementary">
          <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm">
            <ul class="nav bs-docs-sidenav">
              
                <li>
				  <a href="#glyphicons">Glyphicons 字体图标</a>
				  <ul class="nav">
					<li><a href="#glyphicons-glyphs">所有可用的图标</a></li>
					<li><a href="#glyphicons-how-to-use">如何使用</a></li>
					<li><a href="#glyphicons-examples">实例</a></li>
				  </ul>
			</li>
		<li><a href="#wells">Well</a></li>

              
            </ul>
            <a class="back-to-top" href="#top">
              返回顶部
            </a>
            
            <a href="#" class="bs-docs-theme-toggle" role="button">
              主题预览
            </a>
            
          </nav>
        </div>
</div>
</div>
<footer>
	<div class="container">
	<div class="row">   
		<div class="col-md-12">
		
		<p> Copyright ©2014&nbsp;&nbsp;<a href="<?php echo site_url();?>" title="<?php echo $site_name;?>"><?php echo $site_name;?></a>&nbsp;&nbsp;<a href="<?php echo site_url('home/friendlinks')?>" target="_blank">友情链接</a>&nbsp;&nbsp;<a href="<?php echo site_url('home/webmap')?>" target="_blank">网站地图</a></p>
		
		</div>
		</div><!--end of row-->
	 </div>
	</div>
</footer>

<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>
</body>
</html>
