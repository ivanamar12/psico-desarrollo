# Admin

## Registro de Especialista

- Crear status: para hacer softdelete

## Registro de Secretaria

- Crear status: para hacer softdelete

## Registro de Representantes

- Crear status: para hacer softdelete

## Registro de Pacientes

- Crear status: para hacer softdelete



# Secretaria

## Gestion de cita

- Descargar y ver historias

# Especialista

## Ver pacientes, citas

- Validacion de que se muestren solo sus citas

# Nuevos MODULOS

## Generar Informe del paciente

- Descripcion para especialidad

- Tabla de informe

- Informes

- id
- fecha
- fecha_expiracion
- recursos: json
- instrumentos: json
- condiciones_generales: string
- fisica_salud: string
- perseptivo_motriz: string
- coeficiente_intelectual: string
- afectiva_social: string
- conclusion: string
- recomendaciones: string
- especialista_id: int
- paciente_id: int


Schema::create('informes', function (Blueprint $table) {
    $table->id();
    $table->date('fecha_emision');
    $table->date('fecha_vencimiento');
    $table->json('recursos')->nullable();
    $table->json('instrumentos')->nullable();
    $table->text('condiciones_generales')->nullable();
    $table->text('fisica_salud')->nullable();
    $table->text('perceptivo_motriz')->nullable();
    $table->text('coeficiente_intelectual')->nullable();
    $table->text('afectiva_social')->nullable();
    $table->text('conclusion')->nullable();
    $table->text('recomendaciones')->nullable();
    $table->foreignId('especialista_id')->constrained('users');
    $table->foreignId('paciente_id')->constrained('pacientes');
    $table->timestamps(); // Opcional: created_at y updated_at
});
