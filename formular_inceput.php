<?php

include 'lib/f-html.php';

// logica formularului
/*
 * Tipuri de campuri de tip 'choice' (adica de tip alegere)
 * 
 * Printre campurile de tip alegere deosebim 4 tipuri si anume:
 * 
 * ******************************************************************************************************
 * Element html input cu type=checkbox     => la noi vom avea tip=choice, expanded=true, multiple=true
 * Element html input cu type=radio        => la noi vom avea tip=choice, expanded=true, multiple=false
 * Element html select cu multiple         => la noi vom avea tip=choice, expanded=false, multiple=true
 * Element html select cu single           => la noi vom avea tip=choice, expanded=false, multiple=false
 * ******************************************************************************************************
 * 
 */

// definim campurile din formular intr-un array
$campuri = [
                'prenume'=>             [
                                            'name'=>'prenume', //valoarea atributului name
                                            'type'=>'text', // tipul campului
                                            'init_data'=>'', // valoarea atributului value
                                            'required'=>1, // daca campul este obligatoriu
                                        ],      
									

                'nume'=>                [
                                            'name'=>'nume', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                        ],   
                'utilizator'=>          [
                                            'name'=>'utilizator', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                        ],     
                'parola'=>              [
                                            'name'=>'parola', 
                                            'type'=>'password', // camp de tip password
                                            'init_data'=>'', 
                                            'required'=>1,
                                        ], 
                'email'=>               [
                                            'name'=>'email', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                        ],
                'hobby'=>               [
                                            'name'=>'hobby', 
                                            'type'=> 'choice', // camp de tip alegere
                                            'init_data'=>[
                                                            'inot'=>'Inot', 
                                                            'ski'=>'Ski', 
                                                            'alergat'=>'Alergat', 
                                                            'muzica'=>'Muzica', 
                                                         ],
                                            'multiple'=>true,
                                            'expanded'=>true,
                                            'required'=>1,
                                            'data'=>[], // aici vom pune vaorile primite prin $_POST                    
                                        ],  
                'sex'=>                 [
                                            'name'=>'sex', 
                                            'type'=> 'choice', 
                                            'init_data'=>[
                                                            'f'=>'Feminin', 
                                                            'm'=>'Masculin', 
                                                         ],
                                            'multiple'=>false,
                                            'expanded'=>true,
                                            'required'=>1,
                                            'data'=>[], // aici vom pune vaorile primite prin $_POST                    
                                        ],   
                'limbi_straine'=>       [
                                            'name'=>'limbi_straine', 
                                            'type'=> 'choice', 
                                            'init_data'=>[
                                                            'ro'=>'Romana', 
                                                            'en'=>'Engleza', 
                                                            'es'=>'Spaniola', 
                                                            'de'=>'Germana',
                                                         ],
                                            'multiple'=>true,
                                            'expanded'=>false,
                                            'required'=>1,
                                            'data'=>[], // aici vom pune vaorile primite prin $_POST                    
                                        ],   
                'mesaj_utilizator'=>    [
                                            'name'=>'mesaj_utilizator', 
                                            'type'=>'textarea', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                        ], 
];


// aici vom tine eventualele erori
$erori = array();

$mesaj = ''; // mesajul de multumire

if (isset($_POST["buton"])) // in acest if se intra numai daca s-a apasat butonul de trimitere
{	
    
    //var_dump($_POST);exit;
    // preluare variabile din $_POST
    
    // preluare prenume
    if ('' != $_POST['prenume']){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['prenume']['init_data'] = $_POST['prenume'];
        
    } elseif (1==$campuri['prenume']['required']){
        
        $erori['prenume'] = 'Campul prenume este obligatoriu!';
        
    }
    
    // preluare nume
    if ('' != $_POST['nume']){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['nume']['init_data'] = $_POST['nume'];
        
    } elseif (1==$campuri['nume']['required']){
        
        $erori['nume'] = 'Campul nume este obligatoriu!';
        
    }    
    
    // preluare utilizator
    if ('' != $_POST['utilizator']){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['utilizator']['init_data'] = $_POST['utilizator'];
        
    } elseif (1==$campuri['utilizator']['required']){
        
        $erori['utilizator'] = 'Campul utilizator este obligatoriu!';
        
    }      
    
    // preluare parola
    if ('' != $_POST['parola']){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['parola']['init_data'] = $_POST['parola'];
        
    } elseif (1==$campuri['parola']['required']){
        
        $erori['parola'] = 'Campul parola este obligatoriu!';
        
    }     
    
    // preluare sex
    if (isset($_POST['sex'])){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['sex']['data'][] = $_POST['sex'];
        
    } elseif (1==$campuri['parola']['required']){
        
        $erori['sex'] = 'Campul sex este obligatoriu!';
        
    }    
    
    // preluare hobby-uri
    if (isset($_POST['hobby'])){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['hobby']['data'] = $_POST['hobby'];
        
    } elseif (1==$campuri['hobby']['required']){
        
        $erori['hobby'] = 'Alegeti cel putin un hobby!';
        
    }     
    
    // preluare limbi_straine
    if (isset($_POST['limbi_straine'])){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['limbi_straine']['data'] = $_POST['limbi_straine'];
        
    } elseif (1==$campuri['hobby']['required']){
        
        $erori['limbi_straine'] = 'Alegeti cel putin o limba straina!';
        
    }        

    // preluare mesaj_utilizator
    if ('' != $_POST['mesaj_utilizator']){

        // aici urmeaza sa curatim valoarea (eventual cu un cu regex) si apoi o punem in $campuri
        $campuri['mesaj_utilizator']['init_data'] = $_POST['mesaj_utilizator'];
        
    } elseif (1==$campuri['mesaj_utilizator']['required']){
        
        $erori['mesaj_utilizator'] = 'Campul mesaj_utilizator este obligatoriu!';
        
    }   
     }
	 
	     // daca nu sunt erori, procesam (in cazul nostru afisam) datele si mesajul de multumire
    if (!count($erori)) 
    {	 

        $hobby_msg = implode(',', $campuri['hobby']['data']);


        $limbi_straine_msg = implode(',', $campuri['limbi_straine']['data']);

	// mesajul de multumire 
        $mesaj .=  '<br /><hr><br />';
        $mesaj .= 'Va multumim pentru completarea formularului !';
        $mesaj .= '<br />';

        $mesaj .= 'Datele Dvs sunt: <br /><br />';
        $mesaj .= 'Nume: ' . $campuri['prenume']['init_data'] . ' ' . $campuri['nume']['init_data'];
        $mesaj .= '<br />';
        $mesaj .= 'Utilizator: ' . $campuri['utilizator']['init_data'];
        $mesaj .= '<br />';
        $mesaj .= 'Hashul parolei: ' . sha1($campuri['parola']['init_data']);
        $mesaj .= '<br />';
        $mesaj .= 'Email: ' . $campuri['email']['init_data'];
        $mesaj .= '<br />';
        $mesaj .= 'Hobby: ' . $hobby_msg;
        $mesaj .= '<br />';
        $mesaj .= 'Limbi straine: ' . $limbi_straine_msg;
        $mesaj .= '<br />';
        $mesaj .= 'Mesajul tau este: ' . $campuri['mesaj_utilizator']['init_data'];
        $mesaj .= '<br />';        

        $mesaj .= '<br /><hr><br />';
    }  //end if (!count($erori))
	 
echo html_start('ro', 'Formular inceput', '<link href="css/global.css" rel="stylesheet" type="text/css" />')
?>

<?php include_once('tpl/header.php') ?>

<?php include_once('tpl/menu.php') ?>

<!-- begin middle section -->
<div id="content">   
                 
<?php

// daca sunt erori, le afisam intr-un div cu ajutorul functiei write_tag definita in fisierul lib/f-forms.php
if (count($erori)>0){
       echo write_tag('div', 'style="width:300px; background-color:red;padding:10px"',implode('<br />', $erori)) ;
}

    // daca avem ceva in $mesaj il afisam cu ajutorul functie write_tag definita in fisierul lib/f-forms.php
if($mesaj){
       echo  write_tag('div', 'style="width:300px; background-color: #999999;padding:10px"', $mesaj);
} 

?>

    <form id="formular" method="post" action="#" style="width:300px;background-color:#e5e4d7">
            Prenume <br /> <input type="text" name="prenume" value="<?php echo $campuri['prenume']['init_data']?>" /> <br />
            Nume <br /> <input type="text" name="nume" value="" /> <br />
            Utilizator <br /> <input type="text" name="utilizator" value="" /> <br />
            Parola <br /> <input type="password" name="parola" value="" /> <br />
            Email <br /> <input type="text" name="email" value="" /> <br />

            Sexul
            <br /> 
            Feminin: <input type="radio" name="sex" value="f" /> 
            Masculin: <input type="radio" name="sex" value="m" />
            <br />
            Hobby <br />
            Inot   <input type="checkbox" name="hobby[]" value="inot" /> <br />
            Ski <input type="checkbox" name="hobby[]" value="ski"  /> <br />
            Alergat <input type="checkbox" name="hobby[]" value="alergat"  /> <br />
            Cantat <input type="checkbox" name="hobby[]" value="cantat"   /> <br />
            <br />

            Limbi straine vorbite <br />	 
            <select name="limbi_straine[]" multiple="multiple">
                    <option value="ro">Romana</option>
                    <option value="en">Engleza</option>
                    <option value="es">Spaniola</option>
                    <option value="de">Germana</option>
            </select>


            <br /><br />
            Mesaj <br />
            <textarea name="mesaj_utilizator" cols="20" rows="20"></textarea>


            <br /><br />
            <input type="submit" name="buton" value="Trimite" />

            <br />

    </form>    

</div>
<!-- end of middle section  -->	

<?php include_once('tpl/footer.php') ?>




 