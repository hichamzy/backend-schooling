<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif
        }
        h1 {
            text-align: center;
            text-decoration: underline;
        }
        p {
            margin: 5px 0;
        }
        b {
            text-transform: uppercase;
        }
        .date {
            text-align: center;
            width: 260px;
            margin-left: auto;
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    @php
        \Carbon\Carbon::setLocale('fr');  
        $filere = [
            "GI" => "Génie informatique",
            "GA" => "Génie Agricole",
            "TM" => "Téqunique managment",
        ];
        $annee = ["", "1ér", "2émme"];
    @endphp
    <h1>ATTESTAION D'INSCRIPTION</h1>
    <br><br>
    <p>Le Directeur de l'Ecole Supérieur de Technologie Sidi Bennour atteste que l'etudiant :</p>
    <br>
    <p>Monsieur <b>{{$std->nom}} {{$std->prenom}}</b></p>
    <br>
    <p>Numero de la cart d'identite national : <b>{{$std->code_cin}}</b></p>
    <br>
    <p>Code national de l'étudiant : <b>{{$std->code_cne}}</b></p>
    <br>
    <p>né le {{ 
    \Carbon\Carbon::parse($std->date_naissance)->translatedFormat('d F Y')
    }} à {{$std->lieu_naissance}}</p>
    <br>
    <p>est regulierement inscrit à l'Ecole Supérieur de Technologie Sidi Bennour</p>
    <p>pour l'annee universitaire 2021/2020</p>
    <br>
    <p>Diplôme: DUT {{$filere[$std->filier]}}</p>
    <br>
    <p>Année: {{$annee[$std->annee]}} année DUT {{$filere[$std->filier]}}</p>
    <br>
    <div class="date">
        <p>Fait à El Jadida, le {{\Carbon\Carbon::now()->translatedFormat('d F Y')}}</p>
        <p>NAJIB SABER</p>
    </div>
</body>
</html>