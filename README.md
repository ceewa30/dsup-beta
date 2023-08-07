# dsu-beta
Install Docker Engine on Ubuntu

Install using the repository

Before you install Docker Engine for the first time on a new host machine, you need to set up the Docker repository. Afterward, you can install and update Docker from the repository.
Set up the repository

    Update the apt package index and install packages to allow apt to use a repository over HTTPS:

 sudo apt-get update

 sudo apt-get install \
    ca-certificates \
    curl \
    gnupg \
    lsb-release

Add Docker’s official GPG key:

 sudo mkdir -p /etc/apt/keyrings

 curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg

Use the following command to set up the repository:

 echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

Install Docker Engine

    Update the apt package index, and install the latest version of Docker Engine, containerd, and Docker Compose, or go to the next step to install a specific version:

 sudo apt-get update

 sudo apt-get install docker-ce docker-ce-cli containerd.io docker-compose-plugin


Uninstall old versions

sudo apt-get remove docker docker-engine docker.io containerd runc



Create the certificate using Certbot

You can now test that everything is working by running 

docker compose run --rm  certbot certonly --webroot --webroot-path /var/www/certbot/ --dry-run -d democracystraightup.org

You should get a success message like "The dry run was successful"

Volume for Nginx

volumes:
      - ./nginx/conf/:/etc/nginx/conf.d/:ro
      - ./certbot/www:/var/www/certbot/:ro
      - ./certbot/conf/:/etc/nginx/ssl/:ro

Volume for certbot

volumes:
      - ./certbot/www/:/var/www/certbot/:rw
      - ./certbot/conf/:/etc/letsencrypt/:rw

Restart your container using 
docker compose restart


However, this folder is empty right now. Re-run Certbot without the --dry-run flag to fill the folder with certificates:

docker compose run --rm  certbot certonly --webroot --webroot-path /var/www/certbot/ -d democracystraightup.org

ssl_certificate /etc/nginx/ssl/live/example.org/fullchain.pem;
ssl_certificate_key /etc/nginx/ssl/live/example.org/privkey.pem;

Renewing the certificates

docker compose run --rm certbot renew



/etc/letsencrypt/live/democracystraightup.org/fullchain.pem (success)
/etc/letsencrypt/live/www.democracystraightup.org/fullchain.pem (success)



 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'iRUjZ_]Q3I?/zdS.oR?7dTqxB?u@/>iM:L@DKhUC*97_LWtd=70 nR_on#X!Ct;F' );
define( 'SECURE_AUTH_KEY',  'z#cZu9Mtmj}r& ^uXPk=GUX<u]pNO0H7cvGH7I=1>Y-E5l(SO@+p_kQ.WP}l~(/J' );
define( 'LOGGED_IN_KEY',    'YZ7q(D9V#vbv9oGhGDQ{[r<VoT AsM@V{D_05^GPIG]+#;UR26F937L2o`_r5xyv' );
define( 'NONCE_KEY',        '~fMLtS!?6Bx+s}W:xBneNMSLg[ka,,-0^I{Gh28RQea19UrS;R,tDAVuSasZ}:gx' );
define( 'AUTH_SALT',        'V`-,1F$?/|cNq-hBc.d~%#Bhbhcj{=a06nFJ01@,WirnlYQ,B!f/ 97` @ |Z22Y' );
define( 'SECURE_AUTH_SALT', ' wo>nbkWwzN;r|6}x*).214aE:j76K%`Gzo+]jZrO10ID/X5W{woq;GKj1-53z0(' );
define( 'LOGGED_IN_SALT',   ';u~{OS3o%|k5j/)!}DVnS9mgs&jk$-cz$6r/C@@;n+HuKOJlci/<t>UH/Aqt0fbs' );
define( 'NONCE_SALT',       'rGW~C,)lIdm7 ByQH:!roj8idStgM.9@Z<{D9_ydo7)`u%Y_kUr,2xLCGD2oGPek' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


