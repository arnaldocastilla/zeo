<?php
/**
 *
 * @author Willian
 */

interface IGeneral {
    
    public function RegistrarPaciente(Pacientes $pacientes);
    public function RegistrarMedico(Medicos $medicos);
    public function RegistrarHv(Hv $hv);
    public function ListaDepartamento();
    public function ListaMunicipiosPorDepartamento();
    public function ListaHv();
    public function ListaConsultorio();
    public function ListaEtapaTumor();
    public function RegistrarConsultorio(Consultorio $consultorio);
    public function RegistrarEtapaTumor(EtapaTumor $etapatumor);
    public function RegistrarClasificacionTumor(Clasificaciontumor $clasificaciontumor);
    public function RegistrarTipoTumor(Tipotumor $tipotumor);
    public function RegistrarMedicamentos(Medicamentos $medicamentos);
    public function ListaTumorprimario();
    public function ListaGanglioslinfaticos();
    public function ListaMetastasis();
    public function ListaClasificaciontumor();
    public function ListaTipotumor();
    public function ListaMedicamentos();
    public function ListaConsultorios();
    public function PacientesPorId($idPaciente);
    public function ListaMedicamentosId($idMedicamento);
    public function iReportCitaPaciente();
    public function iReportAuxiliarMedico();
    public function iReportPaciente();
    public function iReportActividades();
    public function iReportMedicamentos();
    public function ActualizarMedicamento($datos);
    public function ListarConsultorioId($idConsultorio);
    public function ActualizarConsultorio($datos);
    public function ListarEtapaTumorId($idEtapaTumor);
    public function ActualizarEtapaTumor($datos);
    public function ListarMedicoId($idMedico);
    public function ActualizarMedico($datos);

}

?>