<?php
/**
 * BuddyPress - Members Single Group Invites
 *
 * @since 3.0.0
 * @version 11.0.0
 */
?>

<h2 class="screen-heading group-invites-screen"><?php esc_html_e( 'Group Invites', 'buddyx' ); ?></h2>

<?php bp_nouveau_group_hook( 'before', 'invites_content' ); ?>

<?php if ( bp_has_groups( 'type=invites&user_id=' . bp_displayed_user_id() ) ) : ?>

	<ul id="group-list" class="invites item-list bp-list" data-bp-list="groups_invites">

		<?php
		while ( bp_groups() ) :
			bp_the_group();
			?>

			<li class="item-entry invites-list" data-bp-item-id="<?php bp_group_id(); ?>" data-bp-item-component="groups">

				<div class="wrap list-wrap">

				<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
					<div class="item-avatar">
						<?php if ( function_exists( 'buddypress' ) && version_compare( buddypress()->version, '12.0', '>=' ) ) : ?>
							<a href="<?php bp_group_url(); ?>"><?php bp_group_avatar( bp_nouveau_avatar_args() ); ?></a>
						<?php else : ?>
							<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( bp_nouveau_avatar_args() ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

					<div class="item">
						<div class="item-block">
							<h2 class="list-title groups-title"><?php bp_group_link(); ?></h2>
							<p class="meta group-details">
								<span class="small">
								<?php
								printf(
									/* translators: %s is the number of Group members */
									_n(
										'%s member',
										'%s members',
										bp_get_group_total_members( false ),
										'buddyx'
									),
									number_format_i18n( bp_get_group_total_members( false ) ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								);
								?>
								</span>
							</p>

							<p class="desc">
								<?php bp_group_description_excerpt(); ?>
							</p>

							<?php bp_nouveau_group_hook( '', 'invites_item' ); ?>
						</div>
						<?php
						bp_nouveau_groups_invite_buttons(
							array(
								'container'      => 'ul',
								'button_element' => 'button',
							)
						);
						?>
					</div>

				</div>
			</li>

		<?php endwhile; ?>
	</ul>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'member-invites-none' ); ?>

<?php endif; ?>

<?php
bp_nouveau_group_hook( 'after', 'invites_content' );
