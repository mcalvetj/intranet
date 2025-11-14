<?php
  function connect(){

      $servername = "localhost";
      $username = "phpmyadmin";
      $password = "Unisys00!";
      $dbname = "QTC152";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 
    return $conn;
  }

  function close($conn){
    $conn->close();
  }

  /*function selectUser($rol){
    $conn = connect();
    $sql = "SELECT u.nom, u.pwd
      FROM users u, usr_rol r
      WHERE u.rol = r.rol
      AND r.rol = '".$rol."'";
    $user = $conn->query($sql);
    close($conn);
    return $user;
  }

  function comparePasswd($usr, $pwd){
    $conn = connect();
    $sql = "SELECT pwd FROM users
      WHERE nom = '".$usr."'";
    $passwd = $conn->query($sql);
    close($conn);
  	if ($passwd->num_rows > 0) {
  		while ($row = $passwd->fetch_assoc()) {
        if ($pwd === $row['pwd']) {
          $result = true;
        } else {
          $result = false;
        }
  		}
  	}
    return $result;
  }

  function selectRol($nom){
    $conn = connect();
    $sql = "SELECT rol FROM users
      WHERE nom = '".$nom."'";
    $rol = $conn->query($sql);
    close($conn);
  	if ($rol->num_rows > 0) {
  		while ($row = $rol->fetch_assoc()) {
        $result = $row['rol'];
  		}
  	}
    return $result;
  }

  function selectAlumn(){
    $conn = connect();
    $sql = "SELECT nombre, apellidos, telefono, dni FROM alumnos";
    $data = $conn->query($sql);
    close($conn);
    return $data;
  }

  function selectAss(){
    $conn = connect();
    $sql = "SELECT codigo, descripcion, creditos FROM asignaturas";
    $data = $conn->query($sql);
    close($conn);
    return $data;
  }

  function selectCoo(){
    $conn = connect();
    $sql = "SELECT nombre, dpto, asig, dni FROM coordinadores";
    $data = $conn->query($sql);
    close($conn);
    return $data;
  }

  function selectGrau(){
    $conn = connect();
    $sql = "SELECT nombre, duracion, creditos, tipo_docencia, nota_corte_pau, precio_cre FROM grados";
    $data = $conn->query($sql);
    close($conn);
    return $data;
  }

  function selectProfe(){
    $conn = connect();
    $sql = "SELECT nombre, categoria, dni FROM profesores";
    $data = $conn->query($sql);
    close($conn);
    return $data;
  }
function selectFormulari(){
    $conn = connect();
    $sql = "SELECT * FROM usuario";
    $data = $conn->query($sql);
    close($conn);
    return $data;
  }*/