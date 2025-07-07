<?php
namespace App\Libraries;

class MinhaBiblioteca
{
    public $google='<meta name="google-site-verification" content="K1xZyxGDUKEJgfdE8plXVcgo80I65Qon-lJsJcAjrOE" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5DHM0DXL"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());
    gtag("config", "G-MN5DHM0DXL");
</script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3918009181921323"
        crossorigin="anonymous">
    </script>';


    public function getVariavel()
    {
        return $this->google;
    }
}
