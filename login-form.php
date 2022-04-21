<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message('login'); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url('login', 'login_post'); ?>" method="post">
		<p class="tml-user-login-wrap fa fa-user">
			<?php
            $login_placeholder;
            if ('email' == $theme_my_login->get_option('login_type')) {
                    $login_placeholder = 'E-mail';
            } elseif ('both' == $theme_my_login->get_option('login_type')) {
                    $login_placeholder = 'Username or E-mail';
            } else {
                    $login_placeholder = 'Username';
            }
            ?>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value('log'); ?>" size="20" placeholder="<?php _e($login_placeholder, 'wdm'); ?>"/>
		</p>

		<p class="tml-user-pass-wrap fa fa-key">
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" autocomplete="off" placeholder="<?php _e('Password', 'wdm'); ?>"/>
		</p>

		<?php do_action('login_form'); ?>
		<div class="wdm-lost-password"><a href="/index.php/lostpassword/"><?php _e('Forgot Password?', 'wdm');?></a></div>
		<div class="tml-rememberme-submit-wrap">
			<p class="tml-submit-wrap">
				<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e('Log In', 'theme-my-login'); ?>" />
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url('login'); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="login" />
			</p>
		</div>
	</form>
	<div class="wdm-register-now wdm-register-btn"><?php _e('Not Registered Yet? ', 'wdm');?><a href="#"><?php _e('Register Now', 'wdm');?></a></div>
</div>
