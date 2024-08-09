<?php
	@ob_start();
	include 'include/functions/header.php';
?>
<!doctype html>
<html lang="<?php print $language_code; ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php print $site_title.' - '.$title; if($offline) print ' - '.$lang['server-offline']; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" />
	
	<link rel="stylesheet" href="<?php print $site_url; ?>style/css/bootstrap.css">
	<link rel="stylesheet" href="<?php print $site_url; ?>style/css/style.css">
	<link href="<?php print $site_url; ?>style/css/flag-icon.minc9e4.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php print $site_url; ?>css/bootstrap-tablec9e4.css">
	<link rel="stylesheet" href="<?php print $site_url; ?>css/animationc9e4.css">
	<link href="<?php print $site_url; ?>css/flag-icon.minc9e4.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">
	<link rel='shortcut icon' href='<?php print $site_url; ?>images/favicon.png' type="image/png" sizes="48x48">
	<link rel="stylesheet" href="<?php print $site_url; ?>css/custom.css">
	
	
	
	<style>
        .large:hover {
            height: 90px;
        }
	</style>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5ee552a0b531a90012d0834b&product=inline-share-buttons" async="async"></script>
</head>
<body>



 	



<div class="top-panel">
		
					<div class="top-panel-container flex-center">
			<ul class="menu">
		<li><a href="<?php print $site_url; ?>news"><?php print $lang['news']; ?></a></li>
								<li><a href="<?php print $site_url; ?>users/register"><?php print $lang['register']; ?></a></li>
								<li><a href="<?php print $site_url; ?>download"><?php print $lang['download']; ?></a></li>
				<li><a href="<?php print $site_url; ?>ranking/players"><?php print $lang['players']; ?></a></li>
				<li><a href="https://www.facebook.com/stasiusgames" target="_blank"><?php print $lang['Promocao']; ?></a></li>
					
			</ul>
		</div>
	</div>

<div class="container">

<div class="row mb-1 py-1">
		<div class="col-5.5">
			<a><img src="https://i.imgur.com/OuBnIvE.png" alt="Logo"></a>
		</div>
	</div>

	<div class="row no-gutters mt-5 wrapper">
	
	<!--INCEPUT SIDEBAR-STANGA-->
	
		<aside class="left-sidebar">
		<div class="download-block">
						<a href="<?php print $site_url; ?>download"  target="_blank" class="btn-hover" ><span><?php print $lang['download']; ?></span> Files size: 1.23 Gb</a>
					</div>
			<div class="card">
			
			
					
					
				<div class="login-block p-block2">
				<div class="login-block-title flex-center">
					<span><?php print $lang['user-panel']; ?></span><a href="users/register" class="btn-hover"><?php print $lang['register']; ?></a>		
					</div>
				</div>
				
				<div class="card-body side-petal-left">
					
					<?php if($offline || !$database->is_loggedin()) { ?>
					<form role="form" method="post" action="<?php print $site_url; ?>users/login" accept-charset="UTF-8">
						<div class="form-group">
						<label for="exampleInputEmail1"><?php print $lang['user-name-or-email']; ?></label>
							<input type="text" name="username" pattern=".{5,64}" maxlength="64" class="form-control" placeholder="<?php print $lang['user-name-or-email']; ?>" autocomplete="off" <?php if($offline) print 'disabled'; else print 'required'; ?>>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1"><?php print $lang['password']; ?></label>
							<input type="password" name="password" pattern=".{5,16}" maxlength="16" class="form-control" placeholder="<?php print $lang['password']; ?>" <?php if($offline) print 'disabled'; else print 'required'; ?>>
							
						</div>
						<div  class="g-recaptcha" data-theme="dark" data-sitekey="<?php print $site_key; ?>" style="transform:scale(0.85);-webkit-transform:scale(0.85);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
					
						<div class="login-button flex-center">
							<button type="submit" class="green-button"><?php print $lang['login']; ?></button>
							<a href="<?php print $site_url; ?>users/lost" style="color:#ffffff; margin-top:-15px;"><p></p><?php print $lang['forget-password']; ?></a>
							</div>
					</form><br>
					
					
					
					
					<?php } else { ?>
					<div class="list-group">
						<?php if($web_admin) { ?>
						<a href="<?php print $site_url; ?>admin" class="list-group-item list-group-item-action"><?php print $lang['administration']; ?><?php if($web_admin>=9 && checkUpdate(officialVersion())) print ' <span class="tag tag-info tag-pill float-xs-right">'.$lang['update-available'].'</span>'; ?></a>
						<?php 
							if($web_admin>=$jsondataPrivileges['donate']) {
								$count_donations = count(get_donations());
								if($count_donations)
								{
						?>	
						<a href="<?php print $site_url; ?>admin/donatelist" class="list-group-item list-group-item-action"><?php print $lang['donatelist']; ?> <span class="tag tag-info tag-pill float-xs-right"><?php print $count_donations.' '.$lang['new-donations']; ?> </span></a>
						<?php
								}
							}
						}
						?>
						<a href="<?php print $site_url; ?>user/administration" class="list-group-item list-group-item-action"><?php print $lang['account-data']; ?></a>
						<a href="<?php print $site_url; ?>user/characters" class="list-group-item list-group-item-action"><?php print $lang['chars-list']; ?></a>
						<a href="<?php print $site_url; ?>user/redeem" class="list-group-item list-group-item-action"><?php print $lang['redeem-codes']; ?></a>
						<?php if($jsondataFunctions['active-referrals']) { ?>
						<a href="<?php print $site_url; ?>user/referrals" class="list-group-item list-group-item-action"><?php print $lang['referrals']; ?></a>
						<?php } if($item_shop!="") { ?>
						<a target='_blank' href="<?php print $item_shop; ?>" class="list-group-item list-group-item-action"><?php print $lang['item-shop']; ?></a>
						<?php }
							$vote4coins = file_get_contents('include/db/vote4coins.json');
							$vote4coins = json_decode($vote4coins, true);
							
							if(count($vote4coins))
								print '<a href="'.$site_url.'user/vote4coins" class="list-group-item list-group-item-action">Vote4Coins</a>';
							
							$donate = file_get_contents('include/db/donate.json');
							$donate = json_decode($donate, true);
							
							if(count($donate))
								print '<a href="'.$site_url.'user/donate" class="list-group-item list-group-item-action">'.$lang['donate'].'</a>';
						?>
						<a href="<?php print $site_url; ?>users/logout" class="list-group-item list-group-item-action list-group-item-danger"><?php print $lang['logout']; ?></a>
					</div>
					<?php } ?>
					
				</div>
				
			</div>
			<div class="card">
				
			</div>
			
			
				<div class="login-block p-block2">
					<div class="login-block-title flex-center"><span>Top 10 <?php print $lang['players']; ?></span>
					<a href="../ranking/players">Top 100 »</a>
				</div>	
			<?php include 'include/sidebar/ranking.php'; ?>

				

			</div>
			
		</aside>
		
		
		
<!--SFARSIT SIDEBAR-STANGA-->
		
		
		
		<div class="col-8 content bg-darker">


			<div id="carousel-first" class="carousel slide carousel-fade">
				
				<div class="carousel-inner">
					<div class="carousel-item active" style="background: url(<?php print $site_url; ?>style/img/slider.png);">
						<div class="row pt-5">
							
						</div>
					</div>
					<div class="carousel-item" style="background: url(<?php print $site_url; ?>style/img/slider2.png);"></div>
					<div class="carousel-item" style="background: url(<?php print $site_url; ?>style/img/slider3.png);"></div>
				</div>
			</div>
			<?php
				include 'pages/'.$page.'.php';
			?>
		</div>
		
		
		
		<!--INCEPUT SIDEBAR-DREAPTA-->
		
		<aside class="right-sidebar">
			
			
			<div class="download-block2">
				<a href="users/register" class="btn-hover"><span><?php print $lang['register']; ?></span>START GAME NOW</a>
				</div>
			
			<div class="card">
				<a href="https://www.facebook.com/groups/601245441898331" target="_blank" class="btn-hover"><img src="../style/img/media.png" alt="Magazin de obiecte"></a>
			</div>
			<div class="card">
				<a style="50" href="/itemshop" target="_blank" class="btn-hover"><img src="../style/img/ishop.png" alt="Forum"></a>
			</div>
			
			
			
			
					<?php if(!$offline && $statistics) { ?>
			<div class="card-stats">
			
				<div class="login-block p-block2">
				
					<div class="login-block-title flex-center"><span><?php print $lang['statistics']; ?></span>
				
				</div>	
				</div>
				
			

<div class="stats">
				<ul class="list-group list-group-flush">

							<?php
							if(!$offline)
							foreach($jsondataFunctions as $key => $status)
								if(!in_array($key, array('active-registrations', 'players-debug', 'active-referrals')) && $status)
								{
									$count = getStatistics($key);
									$procent = 100;
									if($count<$max_statistics[$key])
										$procent = intval($count*100/$max_statistics[$key]);
							?>
							<li class="list-group-item bg-transparent">
								
									<span><b><?php print $lang[$key]; ?></b></span>
									
								
								
								
									<span><p><?php print number_format($count, 0, '', '.'); ?></p></span>
								
							</li>
							<?php } ?>
				</ul>
			</div>
			</div>
			<?php } ?>
			
		<div class="card2">
				<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fstasiusgames&tabs=timeline&width=260&height=360&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="260" height="360" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>		</div>
		</div>
		
		
		
		<!--SFARSIT SIDEBAR-DREAPTA-->
		
		
		
		
	</div>
</div>



</div>


 <div id="mini-icons">
			<div class="languagewrapper">
				<a class="current-language flag-icon flag-icon-<?php print $language_code; ?>" type="button" btattached="true"></a>
			<div class="languages">
				<?php
					foreach($json_languages['languages'] as $key => $value)
						if($key != $language_code)
							print '<a href="'.$site_url.'?lang='.$key.'" class="flag-icon flag-icon-'.$key.'"></a>';
				?>
			</div>
		</div>
		<div class="youtube"><a target="_blank" href="<?php print $social_links['youtube']; ?>"><i class="fa fa-youtube"></i></a></div>
		<div class="facebook"><a target="_blank" href="<?php print $social_links['facebook']; ?>"><i class="fa fa-facebook"></i></a></div>
		<div class="whatsapp"><a target="_blank" href="<?php print $social_links['discord']; ?>"><i class="fab fa-whatsapp"></i></a></div>
	</div>
		</div>
<footer>

	
	
		<div class="footer-info">
			<center>
<table width="900">
	<tr>
	<td width="500">

	<td width="300">
		<p><b>STATS</b></p>
		<a href="https://metin2pserver.net/pserver/1709-StasiusMT%40" title="Metin2 Pserver Toplist Ranking" target="_blank">Metin2Pserver.net</a></br>
<!--/Start async trafic.ro/-->
<!-- Start code JS -->
<script src="https://www.wtastats.ro/counter.php?u=legendaxxl" type="text/javascript"></script>
<!-- End code JS -->
<!--/End async trafic.ro/--></br>
<br /><a href="https:" title="P Server FFE2">P Server</a></br>

</tr>
</table>
</center>
<br> </br>
			</div>
	
	
</footer>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="<?php print $site_url; ?>js/main.js"></script>
	<script type="text/javascript" src="<?php print $site_url; ?>js/application.js"></script>
	<?php include 'include/functions/footer.php'; ?>
	<script src="<?php print $site_url; ?>js/tether.min.js"></script>
	<script src="<?php print $site_url; ?>js/bootstrap.min.js"></script>

	<script>
		$('.txt').html(function(i, html) {
			var chars = $.trim(html).split("");
			return '<span>' + chars.join('</span><span>') + '</span>';
		});

		$(".r_title_pvp a").click(function() {
			$("#guilds").hide();
			$("#players").tab('show');
			$("#players").show();
		});

		$(".r_title_guilds a").click(function() {
			$("#players").hide();
			$("#guilds").tab('show');
			$("#guilds").show();
		});
	</script>
	<script>
	$(function() {
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$('#toTop').fadeIn();
					} else {
					$('#toTop').fadeOut();
					}
					});
				$('#toTop').click(function() {
				$('body,html').animate({scrollTop:0},800);
			});
		});
	</script>
	
	<script src="<?php print $site_url; ?>js/jquery.min.js"></script>
	<script src="<?php print $site_url; ?>js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php print $site_url; ?>js/jquery-2.2.4.min.js"></script>
	<?php include 'include/functions/footer.php'; ?>
	<script src="<?php print $site_url; ?>js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 
	<script src="<?php print $site_url; ?>js/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> 
	<script src="<?php print $site_url; ?>js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
</body>