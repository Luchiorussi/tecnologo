<?php 

class Media{
  public $imageInfo;
  public $fileName;
  public $fileType;
  public $fileTempPath;
  //Set destination for upload
  public $userPath = SITE_ROOT.DS.'..'.DS.'Cargas/Usuarios';
  public $productPath = SITE_ROOT.DS.'..'.DS.'Cargas/Mobiliario';

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Mensajes de Errores Para subir los Archivos al Sistema                                          */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/
  public $errors = array();
    public $upload_errors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'Ningun archivo fue subido',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.'
);

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Extenciones Para Poder Subirlos las Imagenes al Sistema (gif,jpg,jpeg,png)                      */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/
  public$upload_extensions = array(
   'gif',
   'jpg',
   'jpeg',
   'png',
  );

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Funcion para Rutas Relacionadas con el Archivo Para Subirlo al Sistema                          */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/

  public function file_ext($filename){
     $ext = strtolower(substr( $filename, strrpos( $filename, '.' ) + 1 ) );
     if(in_array($ext, $this->upload_extensions)){
       return true;
     }
   }


/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Funcion para las Rutas de las Imagenes con el Proceso de los Mnesajes de Error                  */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/

   public function upload($file){
    if(!$file || empty($file) || !is_array($file)):
      $this->errors[] = "Ningun Archivo se ha Seleccionado Para Subirlo al Sistema.";
      return false;

    elseif($file['error'] != 0):
      $this->errors[] = $this->upload_errors[$file['error']];
      return false;

    elseif(!$this->file_ext($file['name'])):
      $this->errors[] = 'Formato de la Imagen Incorrecto para Cargarlo al Sistema. ';
      return false;

    else:
      $this->imageInfo = getimagesize($file['tmp_name']);
      $this->fileName  = basename($file['name']);
      $this->fileType  = $this->imageInfo['mime'];
      $this->fileTempPath = $file['tmp_name'];
     return true;

    endif;
  }


 public function process(){ //Proceso de Cargar Archivos (Imaganes) para el Mobiliario
    if(!empty($this->errors)):
      return false;
    elseif(empty($this->fileName) || empty($this->fileTempPath)):
      $this->errors[] = "La Ubicacion del Archivo No se Encuentra Disponible.";
      return false;
    elseif(!is_writable($this->productPath)):
      $this->errors[] = $this->productPath."¡Debe de Tener Permisos de Escritura.!";
      return false;
    elseif(file_exists($this->productPath."/".$this->fileName)):
      $this->errors[] = "El archivo {$this->fileName} Ya Existe en La Carpeta de Cargas.";
      return false;
    else:
     return true;
    endif;
 }

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Función Para Procesar Archivos Multimedia                                                       */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/

  public function process_media(){ //Proceso de Imagen Para el Mobiliario de la Institución
    if(!empty($this->errors)){
        return false;}

    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La Ubicacion del Archivo No se Encuentra Disponible.";
        return false;}

    if(!is_writable($this->productPath)){
        $this->errors[] = $this->productPath."¡Debe de Tener Permisos de Escritura.!";
        return false;}

    if(file_exists($this->productPath."/".$this->fileName)){
      $this->errors[] = "El Archivo {$this->fileName} Ya Existe en La Carpeta de Cargas";
      return false;}

    if(move_uploaded_file($this->fileTempPath,$this->productPath.'/'.$this->fileName)){

      if($this->insert_media()){
        unset($this->fileTempPath);
        return true;}

    } else {
      $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
      return false;}
  }

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Función Para Procesar Archivos Multimedia                                                       */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/

 public function process_user($id){ //Proceso de Usuario Respecto a su Imagen
    if(!empty($this->errors)){
        return false;}

    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "La Ubicacion del Archivo No se Encuentra Disponible.";
        return false;}

    if(!is_writable($this->userPath)){
        $this->errors[] = $this->userPath."¡Debe de Tener Permisos de Escritura.!";
        return false;}

    if(!$id){
      $this->errors[] = " ID de usuario ausente.";
      return false;}

    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$id.'.' . end($ext);
        $this->fileName = $new_name;
          if($this->user_image_destroy($id)){
            if(move_uploaded_file($this->fileTempPath,$this->userPath.'/'.$this->fileName)){

                if($this->update_userImg($id)){
                    unset($this->fileTempPath);
                  return true;
              }
          } else {
                $this->errors[] = "Error en la carga del archivo, posiblemente debido a permisos incorrectos en la carpeta de carga.";
                return false;}
          }
 }

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Función para Actualizar Imagen de Usuario                                                       */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/

  private function update_userImg($id) { //Actualizar Imagen de Usuario en la parte de Configuración
    global $db;
    $sql = "UPDATE usuario SET";
    $sql .= " ImagenUsuario= '{$db->escape($this->fileName)}' ";
    $sql .= " WHERE id='{$db->escape($id)}'";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
  }

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Función Para Eliminar Imagen Antigua del Usuario                                                */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/

  public function user_image_destroy($id){ //Destruir o Borrar la Antigua Imagen del Usuario
    $image = find_by_id ('usuario',$id);
    if($image['ImagenUsuario'] === 'no_image.jpg'){
      return true;
    } else{
      unlink($this->userPath.'/'.$image['ImagenUsuario']);
      return true;
    }
  }

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Función Para Insertar Imagen Multimedia                                                         */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/

  private function insert_media(){ //Insertar Imagen
    global $db;
    $sql = "INSERT INTO media (NombreMedia, TipoMedia)";
    $sql .= "VALUES";
    $sql .="(
            '{$db->escape($this->fileName)}',
            '{$db->escape($this->fileType)}'
               )";
    return ($db->query($sql) ? true : false);
  }

/*--------------------------------------------------------------------------------------------------*/
/*|                                                                                                 */
/*| Función Para Eliminar Medios por ID                                                             */
/*|                                                                                                 */
/*--------------------------------------------------------------------------------------------------*/  

 public function media_destroy($id,$NombreMedia){ //Eliminar Imagen de Usuario Por Usuario
  $this->fileName = $NombreMedia;
     if(empty($this->fileName)){
    $this->errors[] = "Falta el archivo de foto.";
         return false;
  }
 
  if(!$id){
       $this->errors[] = "ID de foto ausente.";
       return false;
   }

   if(delete_by_id('media',$id)){
      unlink($this->productPath.'/'.$this->fileName);
    return true;
    
   } else{
  $this->error[] = "Se ha producido un error en la eliminación de fotografías.";
       return false;
    }
 }

}


?>