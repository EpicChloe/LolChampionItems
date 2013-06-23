<?php
class JSONTwigExtension extends Twig_Extension {
    public function getName () {
        return 'JSONTwigExtension';
    }

    public function getFunctions () {
        return array(
            $this->getGetJsonFunction()
        );
    }

    public function getGetJsonFunction () {
        return new \Twig_SimpleFunction('get_json', function ($path) {
            $json = file_get_contents(__DIR__.'/'.$path);
            $json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t](//).*)#", '', $json);
            $obj = json_decode($json, true);

            return $obj;
        });
    }
}

$spark->addTwigExtension(new JSONTwigExtension());
