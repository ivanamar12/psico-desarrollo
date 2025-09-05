<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubEscala;

class SubEscalaSeeder extends Seeder
{
  public function run()
  {
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Psicomotricidad', 'descripcion' => 'La prueba contiene siete tareas de las que se pueden obtener hasta 12 puntos, todo esto con el fin de registrar las conductas de su lateralidad']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Lenguaje Articulatorio', 'descripcion' => 'El especialista debe pronunciar cada palabra articulando con claridad y el niño debe pronunciarla cada una con claridad']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Lenguaje Expresivo', 'descripcion' => 'El especialista pronunciará despacio cada frase y el niño las repetirá a continuación. Cada frase pronunciada bien se valorará con 1 punto']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Lenguaje Comprensivo', 'descripcion' => 'A continuación, el especialista le leerá un breve cuento al niño y este deberá responder las preguntas que se le realicen al final de la lectura. "Raquel fue al circo el domingo por la tarde. El circo estaba en la plaza. Su papá le compró palomitas. Actuó un domador de leones, que llevaba una capa, y también payasos muy divertidos. Uno de los trapecistas se cayó sobre la red, y la gente se asustó mucho. Al terminar la función, la niña se marchó a casa de sus abuelos y les contó que lo que más le había gustado fue la función de las focas"']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Estructuración Espacial', 'descripcion' => 'El especialista se situará frente al niño y deberá realizar las órdenes que se le indiquen. Para la última tarea se usará el anexo número uno de la prueba. En caso de que el niño no cumpla todos los objetivos de la prueba, se le pedirá que trace los puntos de la figura del anexo y se marcará con qué mano lo hizo. De lo contrario, si los completa, deberá seguir estas instrucciones realizando los dibujos en la parte inferior de la hoja, tomando en cuenta el punto del medio: "Dibuja dos cuadrados hacia abajo, dos cuadrados hacia la derecha, un cuadrado hacia arriba y un cuadrado hacia la izquierda"']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Visopercepción', 'descripcion' => 'El niño reproducirá, con un lápiz, las figuras que se le representan en las tres páginas del anexo dos. No se usará borrador y si se equivoca se le recomendará hacer mejor la próxima figura. Se acabará la prueba cuando se reproduzcan mal cuatro imágenes seguidas. Al niño se le indicará lo siguiente: "Copia estos dibujos lo mejor que puedas"']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Memoria Icónica', 'descripcion' => 'El especialista presenta al niño una lámina con unas imágenes durante un minuto. Después se le preguntará al niño durante 90 segundos cuáles eran las imágenes y el niño debe responder las que recuerde. Al niño se le darán las siguientes instrucciones: "Te voy a enseñar una lámina con unos dibujos durante un rato, presta mucha atención y después me responderás los dibujos que recuerdes"']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Ritmo', 'descripcion' => 'El especialista mostrará la tarea golpeando la mesa con el otro extremo del lápiz']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Fluidez Verbal', 'descripcion' => 'El niño deberá crear una frase, cuanto más larga mejor, con las palabras que el especialista le dirá a continuación. El especialista deberá anotar literalmente la frase que el niño diga, registrando el número total de palabras de cada oración']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Atención', 'descripcion' => 'El especialista mostrará al niño la página del anexo 3, en la que aparecen 11 filas de figuras geométricas, la primera de las cuales está recuadrada y va a servir de entrenamiento. Se le concederán 30 segundos antes de empezar. Anotar las observaciones de la prueba']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Lectura', 'descripcion' => 'Esta escala solo se aplicará a niños de 5 a 6 años en adelante (a partir de los 60 meses)']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Escritura', 'descripcion' => 'En esta prueba el especialista dictará una serie de palabras y frases que el niño debe escribir en el espacio reservado en el anexo 5 de la prueba. Las palabras empleadas en esta prueba son las mismas que se utilizaron en la prueba de lectura realizada anteriormente']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Lateralidad', 'descripcion' => 'En esta prueba el especialista recapitulará según las pruebas anteriores cuál fue la mano o cuál fue la lateralidad predominante del paciente, agregando una serie de pasos a la prueba']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Desarrollo Verbal', 'descripcion' => 'Esta puntuación se generará según los resultados obtenidos de las evaluaciones de las 3 escalas de lenguaje: Articulatorio, Comprensivo y Expresivo']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Desarrollo no Verbal', 'descripcion' => 'Esta puntuación se generará según los resultados obtenidos de las evaluaciones de las escalas de Psicomotricidad, Estructuración espacial, Visopercepción, Memoria icónica y Ritmo']);
    SubEscala::create(['prueba_id' => '1', 'sub_escala' => 'Desarrollo Global', 'descripcion' => 'Puntuación de los 83 elementos']);
    SubEscala::create(['prueba_id' => '2', 'sub_escala' => 'Dibujo de Figura Humana', 'descripcion' => 'Esta subescala es útil en la identificación de retrasos en el desarrollo, dificultades de aprendizaje y aspectos emocionales subyacentes']);
  }
}
