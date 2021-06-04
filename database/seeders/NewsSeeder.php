<?php

namespace Database\Seeders;

use App\Models\news;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //news::Factory()->create();
        news::create([
            'titulo'      => 'FERNANDO ALSONO VUELVE A LA FORMULA 1',
            'imagen'      => 'fernando-alonso.jpg',
            'descBreve'     => 'Después de dos años, una de las leyendas de la Formula 1 vuelve a la máxima categoría del motor.',
            'cuerpo'     => "Fernando Alonso está de vuelta. Aunque se podría decir que jamás se fue. Desde que el 25 de noviembre de 2018 pronunciara un “hasta luego’” a la que había sido su vida en los últimos 18 años, con dos títulos en el bolsillo y una huella imborrable, su nombre no ha cesado de sonar como futurible de muchos equipos de F1. Mientras, él iba sumando hazañas a su lista, ganando 2 veces las 24 Horas de Le Mans, el Mundial de Resistencia, las 24 Horas de Daytona, un debut espectacular en el Dakar y siguiendo con su intento de la ‘Triple Corona’ en las 500 Millas de Indianápolis.<br><br> Ahora, totalmente centrado en poder beber la mítica leche del ganador en Indianápolis este mes de agosto, llegó el momento para desvelar el secreto que tan bien tenía guardado. Avisaba en pleno confinamiento que anunciaría su futuro en verano y que se había preparado un 2020 con menos carreras para estar listo para un 2021 repleto de trabajo en una “categoría máxima”. Un 2021 en el que la Fórmula 1 estará de enhorabuena. Fernando Alonso volverá con Renault a batallar en la máxima competición del automovilismo mundial el próximo curso.",
            'users_id'     => 1

        ]);

        news::create([
            'titulo'      => 'EL POBRE RENDIMIENTO DE CHECO PÉREZ',
            'imagen'      => 'checho-perez.jpg',
            'descBreve'     => 'El comienzo en Red Bull está siendo complicado para Pérez aunque el mexicano tiene confianza en si mismo',
            'cuerpo'     => "El mexicano tuvo una actuación soberbia gestionando sus neumáticos en las primeras vueltas y, tras un primer stint largo fue capaz de mantener el ritmo suficiente para pasar a tres coches en su parada en boxes.
            <br><br>
            Sin embargo, es inevitable pensar en lo que podría haber sido si se hubiera clasificado más cerca de su compañero de equipo Max Verstappen, en lugar de siete posiciones detrás del holandés.
            <br><br>
            La clasificación sigue siendo un talón de Aquiles para Pérez en 2021 mientras sigue su proceso de adaptación con el RB16B. El segundo puesto en la parrilla en la segunda ronda en Imola sugirió un progreso temprano en conocer el monoplaza, pero posteriormente ha tenido problemas.
            <br><br>
            En Mónaco, las cosas parecían esperanzadoras después de pasar la Q2 en quinto lugar, pero cuando llegó la Q3, las esperanzas se desvanecieron.
            <br><br>
            'Fue un desastre', explicó. 'Estábamos progresando mucho en la clasificación, en la Q2 dimos un buen paso adelante, pero la pista se estaba enfriando y cambiamos nuestro enfoque en la Q3, y en la primera salida a pista no tenía nada de adherencia con el tren delantero'.",
            
            'users_id'     => 1

        ]);


    }
}
