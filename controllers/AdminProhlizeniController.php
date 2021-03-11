<?php

class AdminProhlizeniController extends AdminController {
    public static function vratOtazkyStudent($string) {
        list($trida, $predmet, $ucitel, $skupina, $otazka_id) = explode('-', $string);
        $odpovedi = Databaze::dotaz(
            "SELECT so.odpoved as odpoved, so.id_odpovedi as id, sot.druh as druh
             FROM studenti_odpovedi so 
             INNER JOIN studenti_otazky sot ON so.id_o = sot.id
             WHERE so.id_p = ? and so.id_u = ? and so.trida = ? and so.skupina = ? and so.id_o = ?", array($predmet, $ucitel, $trida, $skupina, $otazka_id));
        
        $odpoved = array();
        for($i = 0; $i < count($odpovedi); $i++) {
            $odpoved[$i] = [
                "odpoved" => $odpovedi[$i]["odpoved"],
                "id" => $odpovedi[$i]["id"],
                "druh" => $odpovedi[$i]["druh"]
            ];
        }
        
        $j_od = json_encode($odpoved);
        
        header("application/json");
        echo $j_od;
    }

    public static function vratOtazkyUcitel($string) {
        list($trida, $predmet, $skupina, $otazka_id) = explode('-', $string);
        $odpovedi = Databaze::dotaz(
            "SELECT uo.odpoved as odpoved, uo.id_odpovedi as id, uot.druh as druh
             FROM ucitele_odpovedi uo 
             INNER JOIN ucitele_otazky uot ON uo.id_o = uot.id 
             WHERE uo.id_p = ? and uo.trida = ? and uo.skupina = ? and uo.id_o = ?",
            array($predmet, $trida, $skupina, $otazka_id));

        $odpoved = array();
        for($i = 0; $i < count($odpovedi); $i++) {
            $odpoved[$i] = [
                "odpoved" => $odpovedi[$i]["odpoved"],
                "id" => $odpovedi[$i]["id"],
                "druh" => $odpovedi[$i]["druh"]
            ];
        }

        $j_od = json_encode($odpoved);
        
        header("application/json");
        echo $j_od;
    }
}