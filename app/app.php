<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();
    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig", array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->get("/allStores", function() use ($app) {
        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->get("/allBrands", function() use ($app) {
        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    $app->post("/addStore", function() use ($app) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $new_store = new Store($name, $address);
        $new_store->save();
        return $app['twig']->render("stores.html.twig", array('stores' =>     Store::getAll()));
    });

    $app->post("/deleteStores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->post("/addBrand", function() use ($app) {
        $name = $_POST['name'];
        $new_brand = new Brand($name);
        $new_brand->save();
        return $app['twig']->render("brands.html.twig", array('brands' =>     Brand::getAll()));
    });

    $app->post("/deleteBrands", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render("brands.html.twig", array('brands' =>     Brand::getAll()));
    });

    $app->get("/thisStore/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post("/addBrandToStore", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->get("/thisBrand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->post("/addStoreToBrand", function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $brand->addStore($store);
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->get("/updateOrDelete/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render("update.html.twig", array('store' => $store));
    });

    $app->patch("/updateStore/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $name = $_POST['name'];
        $address = $_POST['address'];
        $store->update($name, $address);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->delete("/deleteStore/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render("stores.html.twig", array('stores' =>     Store::getAll()));
    });

    return $app;
?>
