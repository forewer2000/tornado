tornado
=======



$route = new Route('specs', 'troll');
$client->addRoute($route);
$client->receive();

(client) - (alpha)  - (server)

(client){want's something} -> 
(alpha) -> check if we have a solution for this
(solution packages)

SolutionMatrix : binds request url with a class in a file 

(client wants:) $_POST, $_GET, URL (from htaccess)

DataMatrix: binds a request data (post/get/file) to a storage format

$gr = new Group('metro');
$dm = new DataMatrix($gr, 'alma', 'korte', 'barack');
$dm->id = 3;

$dm->load();


(client) (solutioner) (datransformator) (datamatrix)

Use Case
- client want something
- solutioner check if we have a solution. 
- load the solution

- the solutioner call a needed datransformator
- the data is sent to the respective datamatrix
- the data is get from the respective datamatrix
- the solutioner call a needed datransformator

- the solutioner assign data to a view
- response sent back to the client

# BROWSER -> APACHE -> HTACCESS -> INDEX -> 
# function of PATH - check if there is a route for this path
#  check if controller exists
#  run controller
# check view is defined
# send view to client


EXAMPLE APACHE:
<VirtualHost *:80>
    DocumentRoot /var/www/tiesto/www
    ServerName tiesto
    ServerAlias tiesto
   <Directory /var/www/tiesto/www>
        Options -Indexes FollowSymLinks MultiViews
        AllowOverride All
        Order allow,deny
        allow from all
    </Directory>
    
    ErrorLog /var/log/apache2/tiesto-error.log
    CustomLog /var/log/apache2/tiesto-access.log combined
</VirtualHost>