<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Zeo/Configuracion/Conexion.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Zeo/Dao/IGeneral.php";
/**
 * Description of ControladorGeneral
 *
 * @author Willian
 */
class ControladorGeneral extends Conexion implements IGeneral {

    public function __construct() {
        parent::ConexionMySQLServer();
    }
    public function cotejamiento() {
        return $this->cnn->query("SET NAMES 'utf8'");
    }
    public function RegistrarPaciente(Pacientes $pacientes) {
         try {
            $sql = "CALL sp_RegisterPaciente (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $pacientes->getTipoidentificacion('tipoidentificacion'),
                $pacientes->getIdentificacion('identificacion'),
                $pacientes->getDepartamentoidentificacion('departamentoidentificacion'),
                $pacientes->getNombre('nombre'),
                $pacientes->getApellido('apellido'),
                $pacientes->getApellidocasada('apellidocasada'),
                $pacientes->getGenero('genero'),
                $pacientes->getFechanacimiento('fechanacimiento'),
                $pacientes->getTiposangre('tiposangre'),
                $pacientes->getTelefono('telefono'),
                $pacientes->getCelular('celular'),
                $pacientes->getEstadocivil('estadocivil'),
                $pacientes->getReligion('religion'),
                $pacientes->getOcupacion('ocupacion'),
                $pacientes->getDepartamento('departamento'),
                $pacientes->getMunicipio('municipio'),
                $pacientes->getDomicilio('domicilio'),
                $pacientes->getEmail('email'),
                $pacientes->getClave('clave'))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
   

    public function RegistrarMedico(Medicos $medicos) {
         try {
            $sql = "CALL sp_RegisterMedico (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $medicos->getTipoidentificacion('tipoidentificacion'),
                $medicos->getIdentificacion('identificacion'),
                $medicos->getDepartamentoidentificacion('departamentoidentificacion'),
                $medicos->getNombre('nombre'),
                $medicos->getApellido('apellido'),
                $medicos->getApellidocasada('apellidocasada'),
                $medicos->getGenero('genero'),
                $medicos->getFechanacimiento('fechanacimiento'),
                $medicos->getTiposangre('tiposangre'),
                $medicos->getTelefono('telefono'),
                $medicos->getCelular('celular'),
                $medicos->getEstadocivil('estadocivil'),
                $medicos->getReligion('religion'),
                $medicos->getDepartamento('departamento'),
                $medicos->getMunicipio('municipio'),
                $medicos->getDomicilio('domicilio'),
                $medicos->getEmail('email'),
                $medicos->getClave('clave'),
                $medicos->getEstado('estado'))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaDepartamento() {
        try {
            self::cotejamiento();
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_ListaDepartamentos();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_departamentos) {
                $departamentos = new Departamentos();
                $departamentos->setIdDepartamento($_departamentos->idDepartamento);
                $departamentos->setDepartamento($_departamentos->departamento);
                $result[] = $departamentos;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaMunicipiosPorDepartamento() {
        try {
            self::cotejamiento();
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_ListaMunicipios();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_municipios) {
                $municipios = new Municipios();
                $municipios->setIdMunicipio($_municipios->idMunicipio);
                $municipios->setMunicipio($_municipios->municipio);
                $municipios->setDepartamento($_municipios->departamento);
                $result[] = $municipios;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaHv() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_ListarHv();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_hv) {
                $hv = new Hv();
                $hv->setIdHv($_hv->idHv);
                $hv->setFoto($_hv->foto);
                $hv->setMedico($_hv->Medico);
                $hv->setTrayectoria($_hv->trayectoria);
                $hv->setExperienciaprofesional($_hv->experienciaprofesional);
                $hv->setLogrosacademicos($_hv->logrosacademicos);
                $hv->setPublicacionesconferencias($_hv->publicacionesconferencias);
                $hv->setIdiomas($_hv->idiomas);
                $result[] = $hv;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarHv(Hv $hv) {
        try {
            $sql = "CALL sp_RegisterHv (?, ?, ?, ?, ?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $hv->getFoto("foto"),
                $hv->getMedico("medico"),
                $hv->getTrayectoria("trayectoria"),
                $hv->getExperienciaprofesional("experienciaprofesional"),
                $hv->getLogrosacademicos("logrosacademicos"),
                $hv->getPublicacionesconferencias("publicacionesconferencias"),
                $hv->getIdiomas("idiomas"))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function ListaMedicos() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_GetMedico ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_medicos) {
                $medicos = new Medicos();
                $medicos->setIdMedico($_medicos->idMedico);
                $medicos->setRol($_medicos->Rol);
                $medicos->setTipoidentificacion($_medicos->tipoidentificacion);
                $medicos->setIdentificacion($_medicos->identificacion);
                $medicos->setDepartamentoidentificacion($_medicos->departamentoidentificacion);
                $medicos->setNombre($_medicos->nombre);
                $medicos->setApellido($_medicos->apellido);
                $medicos->setApellidocasada($_medicos->apellidocasada);
                $medicos->setGenero($_medicos->genero);
                $medicos->setFechanacimiento($_medicos->fechanacimiento);
                $medicos->setTiposangre($_medicos->tiposangre);
                $medicos->setTelefono($_medicos->telefono);
                $medicos->setCelular($_medicos->celular);
                $medicos->setEstadocivil($_medicos->estadocivil);
                $medicos->setOcupacion($_medicos->ocupacion);
                $medicos->setReligion($_medicos->religion);
                $medicos->setPais($_medicos->pais);
                $medicos->setDepartamento($_medicos->departamento);
                $medicos->setMunicipio($_medicos->municipio);
                $medicos->setDomicilio($_medicos->domicilio);
                $medicos->setEmail($_medicos->email);
                $medicos->setClave($_medicos->clave);
                $medicos->setFecharegistro($_medicos->fecharegistro);
                $medicos->setEstado($_medicos->estado);
                $result[] = $medicos;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaConsultorioDetallado() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_Consultorios();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_consultorio) {
                $consultorios = new Consultorio();
                $consultorios->setIdConsultorio($_consultorio->idConsultorio);
                $consultorios->setNombre($_consultorio->nombre);
                $consultorios->setPais($_consultorio->pais);
                $consultorios->setDepartamento($_consultorio->departamento);
                $consultorios->setMunicipio($_consultorio->municipio);
                $consultorios->setDomicilio($_consultorio->domicilio);
                $result[] = $consultorios;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaEtapaTumor() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_listarEtapaTumor ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_etapatumor) {
                $etapatumor = new EtapaTumor();
                $etapatumor->setIdEtapatumor($_etapatumor->idEtapatumor);
                $etapatumor->setNombreetapa($_etapatumor->nombreetapa);
                $etapatumor->setPaciente($_etapatumor->paciente);
                $etapatumor->setTumorprimario($_etapatumor->tumorprimario);
                $etapatumor->setGanglioslinfaticos($_etapatumor->ganglioslinfaticos);
                $etapatumor->setMetastasis($_etapatumor->metastasis);
                $etapatumor->setClasificaciontumor($_etapatumor->nombreclasificacion);
                $etapatumor->setDiagnostico($_etapatumor->diagnostico);
                $result[] = $etapatumor;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarConsultorio(Consultorio $consultorio) {
        try {
            $sql = "CALL sp_registroconsultorio (?, ?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $consultorio->getNombre("nombre"),
                $consultorio->getDepartamento("departamento"),
                $consultorio->getMunicipio("municipio"),
                $consultorio->getDomicilio("domicilio"))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarEtapaTumor(EtapaTumor $etapatumor) {
        try {
            $sql = "CALL sp_regEtapatumor (?, ?, ?, ?, ?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $etapatumor->getNombreetapa("nombreetapa"),
                $etapatumor->getPaciente("Paciente"),
                $etapatumor->getTumorprimario("Tumorprimario"),
                $etapatumor->getGanglioslinfaticos("Ganglioslinfaticos"),
                $etapatumor->getMetastasis("Metastasis"),
                $etapatumor->getClasificaciontumor("Clasificaciontumor"),
                $etapatumor->getDiagnostico("Diagnostico"))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaClasificaciontumor() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_GetClasificaciontumor ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_clasificaciontumor) {
                $clasificaciontumor = new Clasificaciontumor();
                $clasificaciontumor->setIdClasificaciontumor($_clasificaciontumor->idClasificaciontumor);
                $clasificaciontumor->setTipotumores($_clasificaciontumor->Tipotumores);
                $clasificaciontumor->setNombreclasificacion($_clasificaciontumor->nombreclasificacion);
                $clasificaciontumor->setDetalle($_clasificaciontumor->detalle);
                $result[] = $clasificaciontumor;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaGanglioslinfaticos() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_ListaGanglioslinfaticos ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_ganglioslinfaticos) {
                $ganglioslinfaticos = new Ganglioslinfaticos();
                $ganglioslinfaticos->setIdGanglioslinfaticos($_ganglioslinfaticos->idGanglioslinfaticos);
                $ganglioslinfaticos->setCodigogl($_ganglioslinfaticos->codigogl);
                $ganglioslinfaticos->setNombregl($_ganglioslinfaticos->nombregl);
                $ganglioslinfaticos->setDetalle($_ganglioslinfaticos->detalle);
                $result[] = $ganglioslinfaticos;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaMetastasis() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_ListaMetastasis ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_metastasis) {
                $metastasis = new Metastasis();
                $metastasis->setIdMetastasis($_metastasis->idMetastasis);
                $metastasis->setCodigom($_metastasis->codigom);
                $metastasis->setNombrem($_metastasis->nombrem);
                $metastasis->setDetalle($_metastasis->detalle);
                $result[] = $metastasis;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaTipotumor() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_GetTipoTumor ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_tipotumor) {
                $tipotumor = new Tipotumor();
                $tipotumor->setIdTipotumor($_tipotumor->idTipotumor);
                $tipotumor->setCodigotTumor($_tipotumor->codigotTumor);
                $tipotumor->setNombreTumor($_tipotumor->nombreTumor);
                $tipotumor->setDetalle($_tipotumor->detalle);
                $result[] = $tipotumor;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaTumorprimario() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_ListaTumorprimario ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_tumorprimario) {
                $tumorprimario = new Tumorprimario();
                $tumorprimario->setIdTumorprimario($_tumorprimario->idTumorprimario);
                $tumorprimario->setCodigotp($_tumorprimario->codigotp);
                $tumorprimario->setNombretp($_tumorprimario->nombretp);
                $tumorprimario->setDetalle($_tumorprimario->detalle);
                $result[] = $tumorprimario;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarClasificacionTumor(Clasificaciontumor $clasificaciontumor) {
        try {
            $sql = "CALL sp_regClasificaciontumor (?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $clasificaciontumor->getTipotumores("tipotumores"),
                $clasificaciontumor->getNombreclasificacion("nombreclasificacion"),
                $clasificaciontumor->getDetalle("detalle"))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarTipoTumor(Tipotumor $tipotumor) {
        try {
            $sql = "CALL sp_regTipotumor (?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $tipotumor->getCodigotTumor("codigotTumor"),
                $tipotumor->getNombreTumor("nombreTumor"),
                $tipotumor->getDetalle("detalle"))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaConsultorio() {
        try {
            $sql = "CALL sp_NombreConsultorios ();";
            $stmt = $this->cnn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }

            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function ListaMedicamentos() {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_listarMedicamentos ();");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_medicamentos) {
                $medicamentos = new Medicamentos();
                $medicamentos->setIdMedicamento($_medicamentos->idMedicamento);
                $medicamentos->setCodigomaterial($_medicamentos->codigomaterial);
                $medicamentos->setEan($_medicamentos->ean);
                $medicamentos->setNombre($_medicamentos->nombre);
                $medicamentos->setPresentacion($_medicamentos->presentacion);
                $medicamentos->setViaadministracion($_medicamentos->viaadministracion);
                $medicamentos->setDisis($_medicamentos->disis);
                $medicamentos->setEfectosadversos($_medicamentos->efectosadversos);
                $medicamentos->setIndicaciones($_medicamentos->indicaciones);
                $result[] = $medicamentos;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarMedicamentos(Medicamentos $medicamentos) {
        try {
            $sql = "CALL sp_regMedicamentos (?, ?, ?, ?, ?, ?, ?, ?);";
            $this->cnn->prepare($sql)->execute(array(
                $medicamentos->getCodigomaterial("codigomaterial"),
                $medicamentos->getEan("ean"),
                $medicamentos->getNombre("nombre"),
                $medicamentos->getPresentacion("presentacion"),
                $medicamentos->getViaadministracion("viaadministracion"),
                $medicamentos->getDisis("disis"),
                $medicamentos->getEfectosadversos("efectosadversos"),
                $medicamentos->getIndicaciones("indicaciones"))
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function iReportAuxiliarMedico() {
        try {
            $sql = "CALL sp_ireportauxiliarmedico ();";
            $stmt = $this->cnn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }

            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function iReportCitaPaciente() {
        try {
            $sql = "CALL sp_ireportcitapacientemedico ();";
            $stmt = $this->cnn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }

            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function iReportPaciente() {
        try {
            $sql = "CALL sp_ireportpaciente ();";
            $stmt = $this->cnn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }

            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function iReportActividades() {
        try {
            $sql = "CALL sp_ireportactividadespaciente ();";
            $stmt = $this->cnn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }

            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function iReportMedicamentos() {
        try {
            $sql = "CALL sp_ireportmedicamentospaciente ();";
            $stmt = $this->cnn->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }

            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function ListaConsultorios() {
        try {
            self::cotejamiento();
            $sql = "CALL sp_Consultorios();";
            $stmt = $this->cnn->prepare($sql);
            
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }
            return $this->result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function PacientesPorId($idPaciente) {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_listarPacienteId(?);");
            $stm->bindParam(1, $idPaciente);
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_paciente) {
                $paciente = new Pacientes();
                $paciente->setIdPaciente($_paciente->idPaciente);
                $paciente->setRol($_paciente->Rol);
                $paciente->setTipoidentificacion($_paciente->tipoidentificacion);
                $paciente->setIdentificacion($_paciente->identificacion);
                $paciente->setNombre($_paciente->nombre);
                $paciente->setApellido($_paciente->apellido);
                $paciente->setApellidocasada($_paciente->apellidocasada);
                $paciente->setGenero($_paciente->genero);
                $paciente->setFechanacimiento($_paciente->fechanacimiento);
                $paciente->setTiposangre($_paciente->tiposangre);
                $paciente->setTelefono($_paciente->telefono);
                $paciente->setCelular($_paciente->celular);
                $paciente->setEstadocivil($_paciente->estadocivil);
                $paciente->setOcupacion($_paciente->ocupacion);
                $paciente->setReligion($_paciente->religion);
                $paciente->setPais($_paciente->pais);
                
                $paciente->setDomicilio($_paciente->domicilio);
                $paciente->setEmail($_paciente->email);
                $paciente->setClave($_paciente->clave);
                $paciente->setFecharegistro($_paciente->fecharegistro);
                $paciente->setEstado($_paciente->estado);
                $result[] = $paciente;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ListaMedicamentosId($idMedicamento) {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_listaMedicamentosId (?);");
            $stm->bindParam(1, $idMedicamento);
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_medicamentos) {
                $medicamentos = new Medicamentos();
                $medicamentos->setIdMedicamento($_medicamentos->idMedicamento);
                $medicamentos->setCodigomaterial($_medicamentos->codigomaterial);
                $medicamentos->setEan($_medicamentos->ean);
                $medicamentos->setNombre($_medicamentos->nombre);
                $medicamentos->setPresentacion($_medicamentos->presentacion);
                $medicamentos->setViaadministracion($_medicamentos->viaadministracion);
                $medicamentos->setDisis($_medicamentos->disis);
                $medicamentos->setEfectosadversos($_medicamentos->efectosadversos);
                $medicamentos->setIndicaciones($_medicamentos->indicaciones);
                $result[] = $medicamentos;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarMedicamento($datos) {
        try {
            $sql = "CALL sp_actualizarMedicamento (?, ?, ?, ?, ?, ?, ?, ?, ?);   ";
            $stmt = $this->cnn->prepare($sql);
            $stmt->bindParam(1, $datos["idMedicamento"]);
            $stmt->bindParam(2, $datos["codigomaterial"]);
            $stmt->bindParam(3, $datos["ean"]);
            $stmt->bindParam(4, $datos["nombre"]);
            $stmt->bindParam(5, $datos["presentacion"]);
            $stmt->bindParam(6, $datos["viaadministracion"]);
            $stmt->bindParam(7, $datos["disis"]);
            $stmt->bindParam(8, $datos["efectosadversos"]);
            $stmt->bindParam(9, $datos["indicaciones"]);

            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }
            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function ListarConsultorioId($idConsultorio) {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_consultorioId(?);");
            $stm->bindParam(1, $idConsultorio);
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_consultorio) {
                $consultorios = new Consultorio();
                $consultorios->setIdConsultorio($_consultorio->idConsultorio);
                $consultorios->setNombre($_consultorio->nombre);
                $consultorios->setPais($_consultorio->pais);
                $consultorios->setDepartamento($_consultorio->departamento);
                $consultorios->setMunicipio($_consultorio->municipio);
                $consultorios->setDomicilio($_consultorio->domicilio);
                $result[] = $consultorios;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarConsultorio($datos) {
        try {
            $sql = "CALL sp_actualizarConsultorio (?, ?, ?, ?, ?, ?);   ";
            $stmt = $this->cnn->prepare($sql);
            $stmt->bindParam(1, $datos["idCOnsultorio"]);
            $stmt->bindParam(2, $datos["nombre"]);
            $stmt->bindParam(3, $datos["pais"]);
            $stmt->bindParam(4, $datos["departamento"]);
            $stmt->bindParam(5, $datos["municipio"]);
            $stmt->bindParam(6, $datos["domicilio"]);

            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }
            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function ListarEtapaTumorId($idEtapaTumor) {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_listarEtapaTumorId (?);");
            $stm->bindParam(1, $idEtapaTumor);
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_etapatumor) {
                $etapatumor = new EtapaTumor();
                $etapatumor->setIdEtapatumor($_etapatumor->idEtapatumor);
                $etapatumor->setNombreetapa($_etapatumor->nombreetapa);
                $etapatumor->setPaciente($_etapatumor->paciente);
                $etapatumor->setTumorprimario($_etapatumor->tumorprimario);
                $etapatumor->setGanglioslinfaticos($_etapatumor->ganglioslinfaticos);
                $etapatumor->setMetastasis($_etapatumor->metastasis);
                $etapatumor->setClasificaciontumor($_etapatumor->nombreclasificacion);
                $etapatumor->setDiagnostico($_etapatumor->diagnostico);
                $result[] = $etapatumor;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarEtapaTumor($datos) {
        try {
            $sql = "CALL sp_ActualizarEtapaTumor (?, ?, ?, ?, ?, ?, ?, ?);   ";
            $stmt = $this->cnn->prepare($sql);
            $stmt->bindParam(1, $datos["idEtapaTumor"]);
            $stmt->bindParam(2, $datos["nombre"]);
            $stmt->bindParam(3, $datos["paciente"]);
            $stmt->bindParam(4, $datos["tumorprimario"]);
            $stmt->bindParam(5, $datos["ganglioslinfaticos"]);
            $stmt->bindParam(6, $datos["metastasis"]);
            $stmt->bindParam(7, $datos["clasificaciontumor"]);
            $stmt->bindParam(8, $datos["diagnostico"]);

            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }
            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function ListarMedicoId($idMedico) {
        try {
            $result = array();
            $stm = $this->cnn->prepare("CALL sp_listarMedicoId (?);");
            $stm->bindParam(1, $idMedico);
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $_medicos) {
                $medicos = new Medicos();
                $medicos->setIdMedico($_medicos->idMedico);
                $medicos->setTipoidentificacion($_medicos->tipoidentificacion);
                $medicos->setIdentificacion($_medicos->identificacion);
                $medicos->setDepartamentoidentificacion($_medicos->departamentoidentificacion);
                $medicos->setNombre($_medicos->nombre);
                $medicos->setApellido($_medicos->apellido);
                $medicos->setApellidocasada($_medicos->apellidocasada);
                $medicos->setGenero($_medicos->genero);
                $medicos->setFechanacimiento($_medicos->fechanacimiento);
                $medicos->setTiposangre($_medicos->tiposangre);
                $medicos->setTelefono($_medicos->telefono);
                $medicos->setCelular($_medicos->celular);
                $medicos->setEstadocivil($_medicos->estadocivil);
                $medicos->setOcupacion($_medicos->ocupacion);
                $medicos->setReligion($_medicos->religion);
                $medicos->setPais($_medicos->pais);
                $medicos->setDepartamento($_medicos->Departamento);
                $medicos->setMunicipio($_medicos->Municipio);
                $medicos->setDomicilio($_medicos->domicilio);
                $medicos->setEmail($_medicos->email);
                $medicos->setClave($_medicos->clave);
                $medicos->setEstado($_medicos->estado);
                $result[] = $medicos;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarMedico($datos) {
        try {
            $sql = "CALL sp_ActualizarMedico (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);   ";
            $stmt = $this->cnn->prepare($sql);
            $stmt->bindParam(1, $datos["idMedico"]);
            $stmt->bindParam(2, $datos["identificacion"]);
            $stmt->bindParam(3, $datos["departamentoidentificacion"]);
            $stmt->bindParam(4, $datos["nombre"]);
            $stmt->bindParam(5, $datos["apellido"]);
            $stmt->bindParam(6, $datos["apellidocasada"]);
            $stmt->bindParam(7, $datos["genero"]);
            $stmt->bindParam(8, $datos["fechanacimiento"]);
            $stmt->bindParam(9, $datos["tiposangre"]);
            $stmt->bindParam(10, $datos["telefono"]);
            $stmt->bindParam(11, $datos["celular"]);
            $stmt->bindParam(12, $datos["estadocivil"]);
            $stmt->bindParam(13, $datos["domicilio"]);
            $stmt->bindParam(14, $datos["email"]);
            $stmt->bindParam(15, $datos["clave"]);
            $stmt->bindParam(16, $datos["estado"]);
            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->result[] = $row;
            }
            return $this->result;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}

if(isset($_GET["listarConsultorios"]) && $_GET["listarConsultorios"]=="listar"){
    $controller = new ControladorGeneral();
    $r = $controller->ListaConsultorios();
    if(count($r) != 0){
         echo '{
            "data": [';
            for($i=0;$i<count($r)-1;$i++){
            echo ' 
              [
                "'.($i+1).'",
                "'.$r[$i]["nombre"].'",
                "'.$r[$i]["pais"].'",
                "'.$r[$i]["departamento"].'",
                "'.$r[$i]["municipio"].'",
                "'.$r[$i]["domicilio"].'",
                "'.$r[$i]["idConsultorio"].'"
              ],';
            }
            echo ' 
              [
                "'.(count($r)).'",
                "'.$r[$i]["nombre"].'",
                "'.$r[$i]["pais"].'",
                "'.$r[$i]["departamento"].'",
                "'.$r[$i]["municipio"].'",
                "'.$r[$i]["domicilio"].'",
                "'.$r[$i]["idConsultorio"].'"
              ]
            ]
          }';
     }else{
         echo '{
            "data": []
            }';
            
     }
    return;
}

?>