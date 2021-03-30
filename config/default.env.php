<?php

return array(
    /** MySQL hostname */
    'DB_HOST' => 'localhost',
    
    /** Database Charset to use in creating database tables. */
    'DB_CHARSET' => 'utf8',
    
    /** The Database Collate type. Don't change this if in doubt. */
    'DB_COLLATE' => '',
    
    /**#@+
     * Authentication Unique Keys and Salts.
     *
     * Change these to different unique phrases!
     * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
     * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
     *
     * @since 2.6.0
     */

    'AUTH_KEY'         => 'nY-rXxcQZ+DpWU5#h&2zf_6v#/G#ng-.7zjGF+=~-++M]GE2V+VS[*Vib!F<VB8>',
    'SECURE_AUTH_KEY'  => 'b;u|c>02iu6a6`fz]i#/#q|i6H-YaN6(f4efX0u|Zx<u=hdpML IHTG08~%Gx.Lp',
    'LOGGED_IN_KEY'    => 'o5d>73b,?[N>zE|rm/,nXKTnU(!.}>)lEa}Bb^(s$-5G~L1:wS0o+F_XjKg`/w~=',
    'NONCE_KEY'        => '@6bGzZJ|_9e7(/RB~4m*HwNki)(!-3{Kj91}CYYw0#_Dlv4oSA%-D8EKai}Yp5}`',
    'AUTH_SALT'        => 'qvd$H$5BK+[8uAzP:YtC0~^*%P@Ew31Vo|tkb[b+4[7dD?]]5olN0R1hw(u:yn{q',
    'SECURE_AUTH_SALT' => 'y=<`--h.fV%+/.;Y;+yb c4R[1E*:-lKE2|P|mYNW2Wu}Cf%Yh&cL2:9^5+}Yn,<',
    'LOGGED_IN_SALT'   => 'm0w-6/Sr93vVTU69~X/}f:)$aTRlh/I5.^tKZ~:]n9]ww5aDbhUNH,T&XCPp<o[x',
    'NONCE_SALT'       => '9&IVF}?b`B5]|[&yK#@x=MQ8Hx1):Ze+;LxGNP$U*H%L!U0`yP7;LIB+XRL2g7&R',
    
    /**
     * WordPress Localized Language, defaults to English.
     *
     * Change this to localize WordPress.  A corresponding MO file for the chosen
     * language must be installed to wp-content/languages. For example, install
     * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
     * language support.
     */
    'WPLANG' => 'en_CA',
    
    /**
     * For developers: WordPress debugging mode.
     *
     * Change this to true to enable the display of notices during development.
     * It is strongly recommended that plugin and theme developers use WP_DEBUG
     * in their development environments.
     */
    'WP_DEBUG' => false,
    'WP_DEBUG_DISPLAY' => false, 
    
    /**
     * WordPress Database Table prefix.
     *
     * You can have multiple installations in one database if you give each a unique
     * prefix. Only numbers, letters, and underscores please!
     * Note: This is not the default "wp_" for security reasons.
     */
    'table_prefix' => 'wprdm_',
    
);
