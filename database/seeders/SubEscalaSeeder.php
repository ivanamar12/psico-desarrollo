<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubEscala; 

class SubEscalaSeeder extends Seeder
{
    public function run()
    {
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Psicomotricidad','descripcion' => 'La prueba contiene siete tareas de las que se pueden obtener hasta 12 puntos todo esto con el fin de registrar las conductas de su lateralidad']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Lenguaje Articulatorio','descripcion' => 'El especialista debe pronunciar cada palabra articulando con claridad y el niño debe pronunciarla cada una con claridad']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Lenguaje Expresivo','descripcion' => 'El especialista pronunciara despacio cada frase y el niño las repetira a continuacion, cada frase pronuciada  bien se valorara en 1 punto']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Lenguaje Comprensivo','descripcion' => 'A continuación el especialista le leerá un breve cuento al niño y el deberá responder las preguntas que se le realicen al final de la lectura. "Raquel fue al circo el domingo por la tarde. El circo estaba en la plaza. Su papá le compro palomitas. Actuó un domador de leones, que llevaba una capa, y también payasos muy divertidos. Uno de los trapecistas se cayo sobre la red, y la gente se asusto mucho. Al terminar la función la niña se marcho a casa de sus abuelos y le contó que lo que mas le había gustado fue la función de las focas"']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Estructuracion Espacial','descripcion' => 'El especialista se situara frente al niño y deberá realizar las ordenes que se le indiquen. Para la ultima tarea se usara el anexo numero uno de la prueba, en caso de que el niño no cumpla todos los objetivos de la prueba, se le pedirá que trace los puntos de la figura del anexo y se marcara con que mano lo hizo, de lo contrario si los completa deberá, seguir estas instrucciones realizando los dibujos en la parte inferior de la hoja, tomando en cuenta el punto del medio "Dibuja dos cuadrados hacia abajo, dos cuadrados hacia la derecha, un cuadrado hacia arriba y un cuadrado hacia la izquierda"']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Visopercepcion','descripcion' => 'El niño reproducirá, con un lapicero las figuras que se le representan en las tres paginas del anexo dos, no se usara borra y si se equivoca se le recomendara hacer mejor la próxima figura, se acabara la prueba cuando se reproduzcan mal cuatro imágenes seguidas. Al niño se le indicara lo siguiente \"Copia estos dibujos lo mejor que puedas\"']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Memoria Iconica','descripcion' => 'El especialista presenta al niño una lamina con unas imagenes durante un minuto, despues se le preguntara al niño durante 90 segundos cuales eran las imagenes y el niño debe responder las que se acuerde. Al niño se le daran las siguientes instrucciones \"Te voy a enseñar una lamina con unos dibujos durante un rato, presta mucha antencion y despues me responderas los dibujjos que recuerdes\"']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Ritmo','descripcion' => 'El especialista mostrara la tarea golpando la mesa con el otro extremo del lapicero']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Fluidez Verbal','descripcion' => 'El niño debera crear una frase, en cuanto mas larga mejor, con las palabras que el especialista le dira a continuacion, el especialista debera anotar literalmente la frase que el niño diga el niño, registrando el numero total de palabras de cada oracion']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Atencion','descripcion' => 'El especialista mostrara al niño la pagina del anexo 3, en la que aparecen 11 filas de figuras geometricas, la primera de las cuales esta recuadrada y va a servir de entrenamiento, se le concederan 30 segundos antes de empezar anotar las observaciones de la prueba']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Lectura','descripcion' => 'Esta escala solo se aplicara a niños de 5 a 6 años en adelante (a partir de los 60 meses).']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Escritura','descripcion' => 'En esta prueba el especialista dictara una serie de palabras y frases que el niño debe escrbir en el espacio reservado en el anexo 5 de la prueba, las palabras empleadas en esta prueba son las mismas que se utilizaron en la prueba de lectura realizada anteriormente']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Lateralidad','descripcion' => 'En esta prueba el especialista recapitulara segun las pruebas anteriores cual fue la mano o cual fue la lateralidad predominante del paciente, agragndo unas series de pasos a la prueba']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Desarrollo Verbal','descripcion' => 'Esta puntuacion segenerara segun los resultados obtenidos de las evaluaciones de las 3 escalas de lenguaje: Articulatorio, Comprensivo y Expresivo']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Desarrollo no Verbal','descripcion' => 'Esta puntuacion segenerara segun los resultados obtenidos de las evaluaciones de las escalas de Psicomotricidad, Estructuracion espacial, Visopercepcion, Memoria iconica y Ritmo']);
        SubEscala::create(['prueba_id' => '1','sub_escala' => 'Desarrollo Global','descripcion' => 'Puntuacion de los 83 elementos']);
        SubEscala::create(['prueba_id' => '2','sub_escala' => 'Dibujo de Figura Humana','descripcion' => 'Esta subescala es útil en la identificación de retrasos en el desarrollo, dificultades de aprendizaje y aspectos emocionales subyacentes']);

    }
}
