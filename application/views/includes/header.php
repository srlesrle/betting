<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title><?php echo (isset($title) ? $title .' | ' : '');?>  Fenomenalno</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.css" media="screen" />
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    	<!--[if lt IE 9]>
      		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    	<![endif]-->
	<!--<link rel="stylesheet" type="text/css" href="/css/bootstrap-responsive.css" media="screen" />-->
	<link rel="stylesheet" type="text/css" href="/css/fb-button.css" media="screen">
	 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/bootstrap.js" ></script>
	<script type="text/javascript" src="/js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="/js/all.js"></script>
	<script src="/js/bootstrap-affix.js"></script>
	<script src="/js/affix.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/main.css" media="screen" />

	<link rel="stylesheet" type="text/css" href="/css/scroll-follow.css" media="screen" />
	<?php  //var_dump($this->session->all_userdata());
	if(isset($signedup_facebook) && $signedup_facebook == '1'){ ?>
	<script type="text/javascript">
	var fb_param = {};
	fb_param.pixel_id = '6006207249308';
	fb_param.value = '0.00';
	(function(){
  		var fpw = document.createElement('script');
  		fpw.async = true;
  		fpw.src = (location.protocol=='http:'?'http':'https')+'://connect.facebook.net/en_US/fp.js';
  		var ref = document.getElementsByTagName('script')[0];
  		ref.parentNode.insertBefore(fpw, ref);
	})();
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6006207249308&amp;value=0" /></noscript>

	<?php
	//delete userdata signedup
	//$this->session->unset_userdata('signedup', false);
	//var_dump($this->session->userdata('signedup'));
	}
	?>
</head>
<body>
<!--
<div id="right-scroll-follow">
<iframe id="webmaster_frame_id" name="webmaster_frame_name" src="http://lsh.streamhunter.eu/index.php?option=com_lsh&view=lsh&layout=webmaster&tmpl=component" width="100%" height="100%" scrolling="auto" align="top" frameborder="0">Your browser does not support frames!</iframe>
</div>
-->
	<div class="navbar navbar-fixed-top">
      		<div class="navbar-inner">
        		<div class="container-fluid">
          			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            				<span class="icon-bar"></span>
            				<span class="icon-bar"></span>
            				<span class="icon-bar"></span>
          			</a>
          			<a class="brand" href="/"><img src="/images/fenomenalno-logo.png" title="fenomenalno" alt="fenomenalno" width="" height="25"/></a>
				<div class="btn-group pull-right">
					<?php if ($this->session->userdata('u_id') != "") { ?>
            				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              					<i class="icon-user"></i> <?php echo $this->session->userdata['fname'] . ' ' . $this->session->userdata['lname']; ?>
              					<span class="caret"></span>
            				</a>
            				<ul class="dropdown-menu">
              					<li><a href="<?php echo base_url('profile').'/'.$this->session->userdata['u_id']; ?>">Profile</a></li>
              					<li class="divider"></li>
              					<li><a href="<?php echo base_url('login/logout'); ?>">Odjavi se</a></li>
            				</ul>
          				<?php } else {?>
					<span>
						<a href="<?=base_url()?>login/facebook_redirect"><img src="/img/facebook-button.gif" height="30" width="30"  title="facebook"/></a>
						<a type="button" class="btn btn-info" href="<?=base_url()?>login">
							<span class="fb_button_text">
								<!--<img src="/img/facebook-button.gif" width="20" height="20">-->
								&nbsp;Prijavi se</span>
						</a>
					</span>
						<!--<a onclick="login();return false;" class="fb_button fb_button_medium"><span class="fb_button_text">Prijavi se besplatno!</span></a>-->
					<?php } ?>
				</div>
          			<div class="nav-collapse">
            				<ul class="nav">
              					<li class="active"><a href="<?php echo base_url();?>">PO&#268;ETNA</a></li>
              					<li><a href="/users">U&#268;ESNICI</a></li>
              					<li><a href="/stats">STATISTIKA</a></li>
						<!--<li><a href="/pravila">PRAVILA IGRE</a></li>-->
						<li><a href="mailto:webmaster@fenomenalno.com">KONTAKT</a>
            				</ul>
          			</div><!--/.nav-collapse -->
        		</div>
		</div>
    	</div> <!-- div.navbar -->
	<div id="fb-root"></div>
	<div class="container">
		<?php if(uri_string() == '') {?>
		<div class="hero-unit">
	<?php //if(base_url() == current_url()){?>
	<?php if ($this->session->userdata('u_id') != "") { ?>
			<div class="row">
				<div class="span4">
					<!-- Affiliate Code Do NOT Modify--><iframe allowtransparency="true" src="http://affiliates.bet-at-home.com/processing/impressions.asp?btag=a_69132b_30017" width="300"  height="250"  scrolling="no" frameborder="no" style="border-width:0"></iframe><!-- End affiliate Code-->
					<!--<?php foreach($last_club as $l) { ?>
							<table class="" style="" cellpadding="10">
							<tbody>
								<tr>
									<td>
										<h2><?php echo $l->h_yu_name; ?></h2>
										<h4><a href="#"><?php echo $l->h_name; ?> (<?php echo $l->h_short_name; ?>)</a></h4>
									</td>
									<td>
										<img src="/uploads/club/<?php echo $l->h_yu_name; ?>-128<?php echo $l->h_ext;?>" width="150" height="150"/>
									</th>
									<td>
										<h2><?php echo substr($l->time_of_game, 11, -3);?></h2>
									</td>
									<td>
										<img src="/uploads/club/<?php echo $l->g_yu_name; ?>-128<?php echo $l->g_ext;?>" width="150" height="150"/>
									</td>
									<td>
										<h2 class="ident-bot-3"><?php echo $l->g_yu_name; ?></h2>                                                                                                           
										<h4 class="ident-bot-3"><a href="#"><?php echo $l->g_name; ?> (<?php echo $l->g_short_name; ?>)</a></h4>
									</td>
								</tr>
							</tbody>
							</table>
								
					
					<?php } ?>-->
				</div>
				<div class="span4">
					<script type="text/javascript"><!--
						google_ad_client = "ca-pub-3798621824543701";
						/* fenomenalno 300x250 */
						google_ad_slot = "2516456299";
						google_ad_width = 300;
						google_ad_height = 250;
						//-->
					</script>
					<script type="text/javascript"
						src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>
				</div>
				<div class="span3">
					<h2>30 eura svaki mjesec</h2>
					<p>prvi na tabeli svakog prvog i osvajate nagradu!</p>
					<p>Ako ste osvojili nagradu javite se na webmaster @ fenomenalno.com i javite nam paypal email ili moneybookmakers email</p>
				</div>
			</div>
   <?php } else { 
   //}?>
	<div class="row-fluid">
		<div class="span9">
		<h1>Osvoji svaki mjesec &euro;30!</h1>
		<h2>Sta treba da uradim? Pogodite rezultate utakmica, besplatno kla&#273;enje.</h2>
		<h1>Na kraju mjeseca biti prvi na tabeli</h1>
		</div>
		<div class="span2"><br><br><br><br>
			<a type="button" class="btn btn-info" href="<?=base_url()?>signup">
                                                        <span class="fb_button_text">&nbsp;Učlani se</span>
                                                </a>
			<br /> <br />
			<a href="<?=base_url()?>login/facebook_redirect"><img src="/img/facebook-button.gif" title="facebook"/></a>
			<!--<a href="<?=base_url()?>login/recover" class="btn btn-warning">Stari korisnici sa facebook-om klikni ovdje</a>-->
			<!--<a onclick="login();return false;" class="fb_button fb_button_large"><span class="fb_button_text">Prijavi se besplatno!</span></a>-->
		</div>
	</div>
	<?php } ?>
<!--	<div class="row-fluid">
                <div class="span12"><br>
                        <h3>U slucaju da se nemozete prijaviti</h3>
                        <p>Facebook je promjenio pravila igre, tako da cemo biti prinudjeni da promjenimo i ubacimo privatnost (policy), sto smo vec uradili ali cekamo na facebook da odobri prijavu preko facebook-a</p>
                </div>
        </div>-->
		</div><!-- hero-unit-->
<?php } ?>
