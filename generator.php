<?php
/*
@Author : M31337
@Date : Tuesday, May 18, 2021, 20:06
*/

require __DIR__ . '/Requests/library/Requests.php';
require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

function generator()
{
    echo "ingin buat brp?? : ";
    $total = fgets(STDIN);


    echo "\n";
    for ($i = 1 ; $i <= $total ; $i++)

    {

        $data = "ip.txt";
        $rand1 = rand(1,255);
        $rand2 = rand(1,255);
        $rand3 = rand(1,255);
        $rand4 = rand(1,255);

        $result = "$rand1.$rand2.$rand3.$rand4" . PHP_EOL;
        echo $result;

        file_put_contents($data,"\n$rand1.$rand2.$rand3.$rand4", FILE_APPEND);

    }
    file_put_contents($data, implode(PHP_EOL, file($data,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));

}

function checker()
{
    $i = 1;
    echo "Masukan ips with .txt : ";
    $ips = trim(fgets(STDIN));

 
//    $ips = "save.txt"; //list url
    $memek = file_get_contents($ips);
    $pecah = explode("\r\n",$memek);
    $hitung = count($pecah);
    foreach ($pecah as $no => $ip)
    {

//        if (($i % 1) == 0)
//        {
//            echo "\n$i Dari $hitung Sleeping 10 Detik\n" . PHP_EOL;
//            sleep(4);
//        }
        $ppk = $no + 1;
        $http = "http://".$ip;



        try{
            $request = Requests::get($http);
            if ($request !== "200")
            {

                $listvalid = 'live.txt';
                $hasil = $ip . PHP_EOL;
                $valid = "$http => VALID| $ips" . PHP_EOL;
                echo "[$ppk/$hitung] | $valid";
                file_put_contents($listvalid,$hasil,FILE_APPEND);

            }



        }
        catch(Throwable $e){
            echo  "[$ppk/$hitung] | $http - DIE | $ips" . PHP_EOL;
        }

        $i++;


//        file_put_contents($fileip,$http,FILE_APPEND);



    }

//
//    file_put_contents('ip.txt', implode(PHP_EOL, file('ip.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));


}
//

echo "1. Generate Ip\n";
echo "2. Check Ip\n";
echo "\n";
echo "Pilih menu : ";
$pilih = fgets(STDIN);
if ($pilih == 1)
{
    generator();
} elseif ($pilih == 2)
{
    checker();
}



