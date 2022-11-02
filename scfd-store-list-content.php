<div id="dokan-seller-listing-wrap" class="grid-view">
    <div class="seller-listing-content flexslider carousel">
        <ul class="dokan-seller-wrap slides">
            <?php
            $count = 0;
            foreach( $sellers['users'] as $seller ){
                $vendors            = dokan()->vendor->get( $seller->ID );
                $vendors_cat        = $vendors->get_info_part( 'categories' );
                
                $store_banner_id          = $vendors->get_banner_id();
                $store_name               = $vendors->get_shop_name();
                $store_url                = $vendors->get_shop_url();
                $store_rating             = $vendors->get_rating();
                $is_store_featured        = $vendors->is_featured();
                $store_phone              = $vendors->get_phone();
                $store_info               = dokan_get_store_info( $seller->ID);
                $store_address            = dokan_get_seller_short_address( $seller->ID );
                $store_banner_url         = $store_banner_id ? wp_get_attachment_image_src( $store_banner_id, 'full' ) : DOKAN_PLUGIN_ASSEST . '/images/default-store-banner.png';
                $show_store_open_close    = dokan_get_option( 'store_open_close', 'dokan_appearance', 'on' );
                $dokan_store_time_enabled = isset( $store_info['dokan_store_time_enabled'] ) ? $store_info['dokan_store_time_enabled'] : '';
                $store_open_is_on         = ( 'on' === $show_store_open_close && 'yes' === $dokan_store_time_enabled && ! $is_store_featured ) ? 'store_open_is_on' : '';

                if( $vendors_cat[0]->slug == $default_atts['category'] ):
                    ?>
                    
                    <!-- Loop Start -->

                    <li class="dokan-single-seller <?php echo ( ! $store_banner_id ) ? 'no-banner-img' : ''; ?>">

                        <div class="store-wrapper">
                            <div class="store-header">
                                <div class="store-banner">
                                    <a href="<?php echo esc_url( $store_url ); ?>">
                                        <img src="<?php echo is_array( $store_banner_url ) ? esc_attr( $store_banner_url[0] ) : esc_attr( $store_banner_url ); ?>">
                                    </a>
                                </div>
                            </div>

                            <div class="store-content <?php echo ! $store_banner_id ? esc_attr( 'default-store-banner' ) : ''; ?>">
                                <div class="store-data-container">
                                    <div class="featured-favourite">
                                        <?php if ( $is_store_featured ) : ?>
                                            <div class="featured-label"><?php esc_html_e( 'Featured', 'dokan-lite' ); ?></div>
                                        <?php endif ?>

                                        <?php do_action( 'dokan_seller_listing_after_featured', $seller, $store_info ); ?>
                                    </div>

                                    <?php if ( 'on' === $show_store_open_close && 'yes' === $dokan_store_time_enabled ) : ?>
                                        <?php if ( dokan_is_store_open( $seller->ID ) ) { ?>
                                            <span class="dokan-store-is-open-close-status dokan-store-is-open-status" title="<?php esc_attr_e( 'Store is Open', 'dokan-lite' ); ?>"><?php esc_html_e( 'Open', 'dokan-lite' ); ?></span>
                                        <?php } else { ?>
                                            <span class="dokan-store-is-open-close-status dokan-store-is-closed-status" title="<?php esc_attr_e( 'Store is Closed', 'dokan-lite' ); ?>"><?php esc_html_e( 'Closed', 'dokan-lite' ); ?></span>
                                        <?php } ?>
                                    <?php endif ?>
                                    <div class="store-data <?php echo esc_attr( $store_open_is_on ); ?>">
                                        <h2><a href="<?php echo esc_attr( $store_url ); ?>"><?php echo esc_html( $store_name ); ?></a></h2>

                                        <?php if ( ! empty( $store_rating['count'] ) ) : ?>
                                            <div class="dokan-seller-rating"
                                                title="
                                                <?php
                                                    echo sprintf(
                                                        // translators: 1) seller rating
                                                        esc_attr__( 'Rated %s out of 5', 'dokan-lite' ), number_format_i18n( $store_rating['rating'] )
                                                    );
                                                ?>
                                                ">
                                                <?php echo wp_kses_post( dokan_generate_ratings( $store_rating['rating'], 5 ) ); ?>
                                                <p class="rating">
                                                    <?php
                                                    echo esc_html(
                                                        // translators: 1) seller rating
                                                        sprintf( __( '%s out of 5', 'dokan-lite' ), number_format_i18n( $store_rating['rating'] ) )
                                                    );
                                                    ?>
                                                </p>
                                            </div>
                                        <?php endif ?>

                                        <?php if ( ! dokan_is_vendor_info_hidden( 'address' ) && $store_address ) : ?>
                                            <?php
                                            $allowed_tags = [
                                                'span' => [
                                                    'class' => [],
                                                ],
                                                'br'   => [],
                                            ];
                                            ?>
                                            <p class="store-address"><?php echo wp_kses( $store_address, $allowed_tags ); ?></p>
                                        <?php endif ?>

                                        <?php if ( ! dokan_is_vendor_info_hidden( 'phone' ) && $store_phone ) { ?>
                                            <p class="store-phone">
                                                <i class="fas fa-phone-alt" aria-hidden="true"></i> <?php echo esc_html( $store_phone ); ?>
                                            </p>
                                        <?php } ?>

                                        <?php do_action( 'dokan_seller_listing_after_store_data', $seller, $store_info ); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="store-footer">
                                <div class="seller-avatar">
                                    <a href="<?php echo esc_url( $store_url ); ?>">
                                        <img src="<?php echo esc_url( $vendors->get_avatar() ); ?>"
                                            alt="<?php echo esc_attr( $vendors->get_shop_name() ); ?>"
                                            size="150">
                                    </a>
                                </div>
                                <a href="<?php echo esc_url( $store_url ); ?>" title="<?php esc_attr_e( 'Visit Store', 'dokan-lite' ); ?>">
                                    <span class="dashicons dashicons-arrow-right-alt2 dokan-btn-theme dokan-btn-round"></span>
                                </a>
                                <?php do_action( 'dokan_seller_listing_footer_content', $seller, $store_info ); ?>
                            </div>
                        </div>
                    </li>

                    <!-- Loop End -->

                    <?php
                endif;
                $count += 1;

                if( $count == $default_atts['limit'] ){
                    break;
                }
            }
            ?>
        </ul>
    </div>
</div>