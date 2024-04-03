<?php

namespace App;

class Propiedad
{

    //Base de datos
    protected static $db;
    //Arreglo con las columnas de la base de datos para posteriormente recorrerlas con un foreach
    protected static $columnas_db = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function guardar()
    {
        //Si hay un id estamos editando...
        if (isset($this->id)) {
            $this->actualizar();
        } else {
            //Creando nuevo registro
            $this->crear();
        }
    }

    public function crear()
    {
        //Sanitizar los datos: Prevenir entradas de códigos maliciosos por texto
        $atributos = $this->sanitizarDatos();

        //Join, es un método que devuelve un string formateado con separadores, estos separadores respetan la posición de los signos
        //arra_keys y array_values son métodos que devuelven un arreglo, el primero devuelve uno con las llaves de dicho arreglo y el otro con sus valores
        //Obtener un string separado por comas en base a los keys provinientes del arreglo asociativo
        $columns_query = join(', ', array_keys($atributos));

        //Obtener los valores en un string separado por comas en base a un arreglo
        $data_query = join("', '", array_values($atributos));

        //Generar query usandos los strings obtenidos anteriormente
        $query = "INSERT INTO propiedades ( ";
        $query .= $columns_query;
        $query .= ") VALUES (' ";
        $query .= $data_query;
        $query .= " ' )";

        $result = self::$db->query($query);

        //Retornar el resultado
        return $result;
    }

    public function actualizar()
    {
        //Sanitizar los datos: Prevenir entradas de códigos maliciosos por texto
        $atributos = $this->sanitizarDatos();

        $valores = [];
        //Recorremos el arreglo asociativo
        foreach ($atributos as $key => $value) {
            //Por cada iteración aconcatenamos un string siguiendo el patrón detectado..
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . " ' ";
        $query .= " LIMIT 1 ";

        $result = self::$db->query($query);

        return $result;
    }

    ///Eliminar un registro
    public function delete()
    {
        //Elimina la propiedad
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $this -> borrarImagen();

        $result = self::$db->query($query);

        return $result;
    }

    //Definir la conexión a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    //Identificar y unir los atributos de la BD
    public function atributos()
    {
        //Arreglo que vamos a usar para llenarlo con los valores que si sean validos
        $atributos = [];

        foreach (self::$columnas_db as $columna) {
            //Como el id es identity en la base de datos entonces...
            if ($columna === 'id') continue; //Ignora el elemento como id y no lo va a agregar
            //Añade los valores al arreglo con una llave que lleva el nombre de la columna y el valor de la propiedad usando como llave la variable columna del arreglo $columnas db ejemplo $this -> titulo = $this -> $columna (donde columna es un valor del arreglo que debe coincidir con su propiedad)
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    //Sanitiza los datos
    public function sanitizarDatos()
    {
        //Obtenemos el arreglo con atributos en un arreglo asociativo mapeado
        $atributos = $this->atributos();

        $sanitizado = [];

        //Obtener valor de la llave y su valor usando el arreglo asociativo creado con atributos()
        foreach ($atributos as $key => $value) {
            //Sanitizar valor y añadirlo al arreglo de sanitizado usando la key y el valor para sanitizar
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        //Retornamos el arreglo con valores sanitizados
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen)
    {

        //Elimina la imagen previa - si existe un id en el objeto quiere decir que estamos editando
        if (isset($this->id)) {
            $this -> borrarImagen();
        }

        //Asignar al atributo imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function borrarImagen()
    {
        //Comporbar que el archivo existe - como aún no se aplica el seteo del nombre, estaremos accediendo al valor anterior
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        //Si el archivo existe
        if ($existeArchivo) {
            //Eliminar el archivo
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public static function getErrores()
    {
        return self::$errores;
    }

    //Funcion que realiza la validación cuando ya hay una instancia creada
    public function validar()
    {
        //Usada para convertir de bytes a kb en este caso son 10mb
        $medida = 1250000;

        //Si no existe un título es decir está vacío
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título"; //Añadimos un error al aarreglo
        }

        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }

        if ($this->descripcion == null) {
            self::$errores[] = "La descripción es obligatoria y debe ser menor a 50 caracteres";
        }

        if (strlen($this->descripcion) > 50) {
            self::$errores[] = "La descripción no puede ser mayor a 50 caracteres";
        }

        if (!$this->imagen) {
            self::$errores[] = "No has elegido una imagen";
        }

        if ($this->imagen === 'OUT_OF_SIZE') {
            self::$errores[] = "El tamaño de la imagen es mayor al admitido por el servidor, intenta subir otro archivo menos pesado";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if (!$this->wc) {
            self::$errores[] = "El número de wc es obligatorio";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "El número de estacionamientos es obligatorio";
        }

        if (!$this->vendedores_id) {
            self::$errores[] = "Elige un vendedor";
        }

        return self::$errores;
    }

    //Lista todas las propiedades 
    public static function all()
    {
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca una propiedad por su id
    public static function find($id)
    {
        $query = "SELECT * FROM propiedades WHERE id = $id";

        $resultado = self::consultarSQL($query);

        //Retornar el primer valor del arreglo -  La función devuelve la primera posición de cualquier arreglo
        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        //Consultar la base
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            //Llena un arreglo con objetos previamente creados con crear objeto
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar la consulta
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        //Crea un objeto de la misma clase
        $objeto = new self;

        //Recorrer arreglo asociativo clave y valor
        foreach ($registro as $key => $value) {
            //Verificar que la propiedad exista 1er parámetro es el objeto, 2do parámetro es el valor
            if (property_exists($objeto, $key)) {
                //Al objeto con la clave que viene del registro, se le añade el valor
                $objeto->$key = $value;
            }
        }

        //Retornamos el objeto creado
        return $objeto;
    }

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {

        //Recorrer arreglo asociativo recibido
        foreach ($args as $key => $value) {

            //Verificar que la clave recibida exista dentro del objeto en memoria y que también el valor sea diferente de nulo
            if (property_exists($this, $key) && !is_null($value)) { //Cuando se usa $this hace referencia a toda la clase actual si se instancia un objeto en memoria, haría referencia a ese objeto

                //Asignar los valores nuevos al objeto en memoria
                $this->$key = $value;
            }
        }
    }
}
