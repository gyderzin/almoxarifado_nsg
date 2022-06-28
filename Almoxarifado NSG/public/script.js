// VALIDAR INDEX

function validarLogin() {
     var email = document.getElementById('input_email')
     var senha = document.getElementById('input_senha')
     var form = document.getElementById('form_login')
     var btn = document.getElementById('btn_login')
     var small = document.getElementById('small_login')
     

     if(email.value != '' && senha.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'text-danger'
          if (email.value != '') {
               email.className = 'form-control border-success'
          }
          else {
               email.className = 'form-control border-danger'
          }
          if (senha.value != '') {
               senha.className = 'form-control border-success'
          }
          else {
               senha.className = 'form-control border-danger'
          }
     }
     
}

function validarInscreverse() {
     var nome = document.getElementById('nome_inscreverse')
     var email = document.getElementById('email_inscreverse')
     var senha = document.getElementById('senha_inscreverse')
     var form = document.getElementById('form_inscreverse')
     var btn = document.getElementById('btn_inscreverse')
     var small = document.getElementById('small_inscreverse')
     

     if(nome.value != '' && email.value != '' && senha.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'text-danger'
          if (nome.value != '') {
               nome.className = 'form-control border-success'
          }
          else {
               nome.className = 'form-control border-danger'
          }
          if (email.value != '') {
               email.className = 'form-control border-success'
          }
          else {
               email.className = 'form-control border-danger'
          }
          if (senha.value != '') {
               senha.className = 'form-control border-success'
          }
          else {
               senha.className = 'form-control border-danger'
          }
     }
}

// AO INICIAR QUALQUER PAG
function onLoad (GET = null, painel) {          
     if(GET != 'sucesso' && GET != 'erro' && GET != '' ) {          
          var ico = document.getElementById('confirmRemoveFerramenta');
          ico.click()                    
     }  
     console.log(painel);
     // SCROLL PAINEL           
     if(painel['pathname'] == '/painel_materiais') {
          var painel_n1 = document.getElementById('scroll_painel')
          var aux_n2 = document.getElementById('auxiliar_scroll_painel')
          var qtd_n3 = document.getElementById('qtd_mat_painel')     

          var painel = Number(painel_n1.offsetHeight)     
          var aux_painel = Number(aux_n2.offsetHeight)
          var qtd_mat = Number(qtd_n3.innerHTML)

          var div_painel = aux_painel * qtd_mat     

          if (div_painel >= painel) {               
               painel_n1.style.width = '104.2%'
          }
     }

     // SCROLL PAINEL_FERRAMENTAS
     else if(painel['pathname']== '/painel_ferramentas') {     
          var painel_ferramentas_n1 = document.getElementById('scroll_painel_ferramentas')
          var aux_ferramentas_n2 = document.getElementById('auxiliar_scroll_painel_ferramentas')
          var qtd_ferramentas_n3 = document.getElementById('qtd_mat_painel_ferramentas')     

          var painel_ferramentas = Number(painel_ferramentas_n1.offsetHeight)
          var aux_painel_ferramentas = Number(aux_ferramentas_n2.offsetHeight)
          var qtd_ferramentas = Number(qtd_ferramentas_n3.innerHTML)
         
          var div_painel_ferramentas = aux_painel_ferramentas * qtd_ferramentas          

          if (div_painel_ferramentas >= painel_ferramentas) {               
               painel_ferramentas_n1.style.width = '104.2%'
          }
     }

     // SCROLL PAINEL_FUNCIONARIOS     
     else if(painel['pathname'] == '/painel_funcionarios') {     
          var painel_funcionarios_n1 = document.getElementById('scroll_painel_funcionarios')
          var aux_funcionarios_n2 = document.getElementById('auxiliar_scroll_painel_funcionarios')
          var qtd_funcionarios_n3 = document.getElementById('qtd_painel_funcionarios')      

          var painel_funcionarios = Number(painel_funcionarios_n1.offsetHeight)
          var aux_painel_funcionarios = Number(aux_funcionarios_n2.offsetHeight)
          var qtd_funcionarios = Number(qtd_funcionarios_n3.innerHTML)
        
          var div_painel_funcionarios = aux_painel_funcionarios * qtd_funcionarios    
          

          if (div_painel_funcionarios >= painel_funcionarios) {               
               painel_funcionarios_n1.style.width = '104.2%'
          }      
     }

      // SCROLL PAINEL_HISTORICO
      else if(painel['pathname'] == '/painel_historico') {     
          var painel_historico_n1 = document.getElementById('scroll_painel_historico')
          var aux_historico_n2 = document.getElementById('auxiliar_scroll_painel_historico')
          var qtd_historico_n3 = document.getElementById('qtd_painel_historico')

          var painel_historico = Number(painel_historico_n1.offsetHeight)
          var aux_painel_historico = Number(aux_historico_n2.offsetHeight)
          var qtd_historico = Number(qtd_historico_n3.innerHTML)

          console.log(painel_historico)
          console.log(aux_painel_historico)
          console.log(qtd_historico)

          var div_painel_historico = aux_painel_historico * qtd_historico

          if (div_painel_historico >= painel_historico) {
               painel_historico_n1.style.width = '104.2%'
          }
     }
           
}

function auxiliarScrollFuncionarios(id) {     
     var collapseInfo = document.getElementById('collapseInfo'+id)
     collapseInfo.offsetHeight()
     
}
// AUTENTICAR 
function passwordTextEnter(input) {
     var input = document.getElementById(input)
     var btn_olho = document.getElementById('btn_olho')
     input.type = 'text'
     btn_olho.className = 'btn btn-secondary fa-regular fa-eye-slash disabled'     
}
function passwordTextOut(input) {
     var input = document.getElementById(input)
     var btn_olho = document.getElementById('btn_olho')
     btn_olho.className = 'btn btn-secondary fa-regular fa-eye disabled'
     input.type = 'password'
}
// INSTANCIAS PARA USO DO BOOTSTRAP
$(function () {
     $('[data-toggle="tooltip"]').tooltip()
})
$('.collapse').collapse()

// BUTTONS BARRA DE NAVEGAÇAO
function painel_ferramentas() {
     window.location = '/painel_ferramentas'     
}
function painel_materiais() {
     window.location = '/painel_materiais'     
}
function painel_historico() {
     window.location = '/painel_historico'
}
function painel_funcionarios() {
     window.location = '/painel_funcionarios'
}

// COLLAPSE PAINEL_FUNCIONARIOS

function colapse_ferramentas(param) {         
     
     var ferramentas = document.getElementById('collapseFerramentas'+param)
     var historico = document.getElementById('collapseHistorico'+param)
     var info = document.getElementById('collapseInfo'+param)     
     var ico_ferramentas = document.getElementById('ico_ferramentas'+param)
     var ico_historico = document.getElementById('ico_historico'+param)
     var ico_info = document.getElementById('ico_info'+param)    

     ico_ferramentas.className = 'fa-solid fa-screwdriver-wrench ico_ferramentas_func text-primary'
     ico_historico.className = 'fa-solid fa-clock-rotate-left ico_ferramentas_func'
     ico_info.className = 'fa-solid fa-address-card ico_ferramentas_func'

     if(ferramentas.className == 'row bg-secondary div_ferramentas collapse show') {
          ico_ferramentas.className = 'fa-solid fa-screwdriver-wrench ico_ferramentas_func'
     }

     if(historico.className == 'row bg-light div_ferramentas collapse show'){
         historico.className = 'row bg-light div_ferramentas collapse'
     }
     if(info.className == 'row bg-info div_ferramentas collapse show'){
          info.className = 'row bg-info div_ferramentas  collapse'
     }
   
}

function colapse_historico(param) {
     var historico = document.getElementById('collapseHistorico'+param)
     var ferramentas = document.getElementById('collapseFerramentas'+param)     
     var info = document.getElementById('collapseInfo'+param)
     var ico_ferramentas = document.getElementById('ico_ferramentas'+param)
     var ico_historico = document.getElementById('ico_historico'+param)
     var ico_info = document.getElementById('ico_info'+param)

     ico_ferramentas.className = 'fa-solid fa-screwdriver-wrench ico_ferramentas_func'
     ico_historico.className = 'fa-solid fa-clock-rotate-left ico_ferramentas_func text-primary'
     ico_info.className = 'fa-solid fa-address-card ico_ferramentas_func'     
          
     console.log(historico.offsetHeight)


     if(historico.className == 'row bg-light div_ferramentas collapse show') {
          ico_historico.className = 'fa-solid fa-clock-rotate-left ico_ferramentas_func'
     }

     if(ferramentas.className == 'row bg-secondary div_ferramentas collapse show'){
          ferramentas.className = 'row bg-secondary div_ferramentas collapse'
      }
      if(info.className == 'row bg-info div_ferramentas collapse show'){
           info.className = 'row bg-info div_ferramentas  collapse'
      }

}
function colapse_info(param) {

     var info = document.getElementById('collapseInfo'+param)
     var ferramentas = document.getElementById('collapseFerramentas'+param)     
     var historico = document.getElementById('collapseHistorico'+param)    
     var ico_ferramentas = document.getElementById('ico_ferramentas'+param)
     var ico_historico = document.getElementById('ico_historico'+param)
     var ico_info = document.getElementById('ico_info'+param)

     ico_ferramentas.className = 'fa-solid fa-screwdriver-wrench ico_ferramentas_func'
     ico_historico.className = 'fa-solid fa-clock-rotate-left ico_ferramentas_func '
     ico_info.className = 'fa-solid fa-address-card ico_ferramentas_func text-primary'                


     if(info.className == 'row bg-info div_ferramentas collapse show') {
          ico_info.className = 'fa-solid fa-address-card ico_ferramentas_func'
     }

     if(ferramentas.className == 'row bg-secondary div_ferramentas collapse show'){
          ferramentas.className = 'row bg-secondary div_ferramentas collapse'
      }

      if(historico.className == 'row bg-light div_ferramentas collapse show'){
          historico.className = 'row bg-light div_ferramentas collapse'
      }

}

// ICONE DE USARIO / CAMERA DO PAINEL_FUNCIONARIOS -> COLLAPSE_INFO

function mudarIco() {
     var auxiliar = document.getElementsByClassName('auxiliarIco')    
     var ico = document.getElementsByClassName('ico_user')
     for (n1 = 0; n1 < auxiliar.length; n1++) {
          auxiliar[n1].className = 'fa-solid fa-camera ico_camera text-light auxiliarIco visible'
     }
     for (n1 = 0; n1 < ico.length; n1++) {
          ico[n1].style = 'color: black;'
     }
}
function esconderIco() {
     var auxiliar = document.getElementsByClassName('auxiliarIco')     
     var ico = document.getElementsByClassName('ico_user')
     for (n1 = 0; n1 < auxiliar.length; n1++) {
          auxiliar[n1].className = 'fa-solid fa-camera ico_camera text-light auxiliarIco invisible'
     }
     for (n1 = 0; n1 < ico.length; n1++) {
          ico[n1].style = 'color: #343a40;'
     }
}

// MODAL DE INSERÇAO DE NOVO FUNCIONARIO
function novoFuncionario() {
     var nome = document.getElementById('nome')
     var funcao = document.getElementById('Funçao')
     var contrato = document.getElementById('Contrato')     
     var form = document.getElementById('form_add')  
     var div_btn = document.getElementById('div_btn')  
     var small = document.getElementById('campos_nao_preenchidos')
     var label_nome = document.getElementById('label_nome')
     var label_funcao = document.getElementById('label_funcao')
     var label_contrato = document.getElementById('label_contrato')     

     if (nome.value != '' && funcao.value != 'Selecione a função do funcionário (obrigatório)' && contrato.value != 'Contrato no qual o funcionário trabalha (obrigatório)') {
          form.appendChild(div_btn)          
     }
     else {         
          small.className = 'text-danger visible'          
          if(nome.value == '') {                       
               label_nome.className = 'col-sm-2 col-form-label text-danger'
          }
          else {
               label_nome.className = 'col-sm-2 col-form-label text-success'
          }

          if(funcao.value == 'Selecione a função do funcionário (obrigatório)') {                       
               label_funcao.className = 'col-sm-2 col-form-label text-danger'
          }
          else {
               label_funcao.className = 'col-sm-2 col-form-label text-success'
          }

          if(contrato.value == 'Contrato no qual o funcionário trabalha (obrigatório)') {                       
               label_contrato.className = 'col-sm-2 col-form-label text-danger'
          }
          else {
               label_contrato.className = 'col-sm-2 col-form-label text-success'
          }
     }
}

// MODAL DE DESLIGAMENTO DE FUNCIONARARIO
function desligarFuncionario() {
     var confirmar = document.getElementById('caixa')
     confirmar.className = 'caixa_opcao_transition' 
}
function change() {
     var input = document.getElementsByName('select')
     if(input[0].checked == true) {
          var btn = document.getElementById('btn_submit')
          btn.className = 'btn btn-dark visible'
     }
     else {                    
          var btn_fecha_modal = document.getElementById('fecha_modal')
          btn_fecha_modal.click()       
          var btn = document.getElementById('btn_submit')
          btn.className = 'btn btn-dark invisible'
          var confirmar = document.getElementById('caixa')
          confirmar.className = 'caixa_opcao' 
     }
}
function validarFuncionario() {
     var funcionário = document.getElementById('funcionariosDesliga')
     console.log(funcionário.value)
     if(funcionário.value == '---Funcionário---') {
          var small = document.getElementById('retorno_select_func')
          var label = document.getElementById('label_desliga_func')
          small.className = 'text-danger visible'
          label.className = 'text-danger'
     }
     else {
          var div = document.getElementById('btn_delisga_func')
          var form = document.getElementById('form_desliga_func')
          form.appendChild(div)
          
     }
}

// MODAL EDITAR FUNCIONARIO
function validarEdit(id) {
     var nome = document.getElementById('nomeEdit'+id)
     var small = document.getElementById('retorno_edit'+id)
     var label = document.getElementById('labe_edit_nome'+id)
     var form = document.getElementById('form_edit'+id)
     var btn = document.getElementById('caixa_btn_edit'+id)

     console.log(nome)
     if(nome.value == '') {
          small.className = 'text-danger visible'
          label.className = 'col-sm-2 col-form-label text-danger'
     }
     else {
          form.appendChild(btn)
     }
}

// MODAL ADICIONAR MATERIAL
function validarNovoMaterial() {
     var material = document.getElementById('novoMat')
     var qtd = document.getElementById('qtdNovoMat')
     var btn = document.getElementById('caixa_btn_novo_material')
     var form = document.getElementById('form_novo_material')
     var label_mat = document.getElementById('label_novo_mat')
     var label_qtd = document.getElementById('label_qtd_novo_mat')
     var small = document.getElementById('small_novo_mat')

     material.value.trim()

     if (material.value != '' && qtd.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'visible text-danger'          
          if(material.value == '') {
               label_mat.className = 'text-danger'
          }
          else {
               label_mat.className = 'text-success'
          }
           
          if (qtd.value == '') {
               label_qtd.className = 'text-danger'
          }
          else {
               label_qtd.className = 'text-success'
          }
     }
}

// MODAL EXCLUIR MATERIAL 
function validarExclusaoMaterial() {
     var material = document.getElementById('excluirMat')
     var btn = document.getElementById('caixa_btn_excluir_material')
     var form = document.getElementById('form_excluir_material')
     var label_mat = document.getElementById('label_excluir_mat')
     var small = document.getElementById('small_excluir_material')

     if(material.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'visible text-danger'
          label_mat.className = 'text-danger'
     }
}

// MODAL ADICIONAR MATERIAL
function validarAddMaterial(id) {
     var qtd = document.getElementById('qtdAdicionarMaterial'+id)
     var funcionario = document.getElementById('funcionariosAdicionarMaterial'+id)
     var btn = document.getElementById('caixa_btn_adicionar_material'+id)
     var form = document.getElementById('formAdicionarMaterial'+id)
     var label_qtd = document.getElementById('labelAdicionarMaterial'+id)
     var label_func = document.getElementById('labelFuncionariosAddMat'+id)
     var small = document.getElementById('small_adicionar_material'+id)
     var agencia = document.getElementById('agencia_add_mat'+id)
     var label_agencia = document.getElementById('label_agencia_add_mat'+id)
     var data = document.getElementById('input_date_add_mat'+id)
     var label_data = document.getElementById('label_data_add_mat'+id)

     if(qtd.value != '' && funcionario.value != '0' && agencia.value != '0' && data.value != '') {
          form.appendChild(btn)
     }
     else {             
          small.className = 'pt-1 text-danger visible'
          if(qtd.value == '') {
               label_qtd.className = 'text-danger'
          }
          else {
               label_qtd.className = 'text-success'
          }

          if(funcionario.value == '0') {
               label_func.className = 'text-danger'
          }
          else {
               label_func.className = 'text-success'
          }        
          if (agencia.value == '0') {
               label_agencia.className = 'text-danger'
          }
          else {
               label_agencia.className = 'text-success'
          }
          if (data.value == '') {
               label_data.className = 'text-danger'
          }
          else {
               label_data.className = 'text-success'
          }  
     }
}

// MODAL REMOVER MATERIAL 
function validarSaidaMaterial(id) {
     var form = document.getElementById('form_remove_material'+id)
     var label_qtd = document.getElementById('label_qtd_remove_material'+id)
     var qtd = document.getElementById('qtdRemoveMat'+id)
     var funcionarios = document.getElementById('funcionariosRemoveMat'+id)
     var label_func = document.getElementById('label_funcinarios_remove_mat'+id)
     var btn = document.getElementById('caixa_btn_remove_mat'+id)
     var small = document.getElementById('small_remove_mat'+id)
     var agencia = document.getElementById('agencia_remove_mat'+id)
     var label_agencia = document.getElementById('label_agencia_remove_mat'+id)
     var data = document.getElementById('input_date_remov_mat'+id)
     var label_data = document.getElementById('label_data_remov_mat'+id)
     
     console.log(data.value)

     if(qtd.value != '' && funcionarios.value != '0' && agencia.value != '0' && data.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'pl-3 pb-3 text-danger visible'
          if(qtd.value == '') {
               label_qtd.className = 'text-danger'
          }
          else {
               label_qtd.className = 'text-success'
          }

          if(funcionarios.value == '0') {
               label_func.className = 'text-danger'
          }
          else {
               label_func.className = 'text-success'
          }
          if (agencia.value == '0') {
               label_agencia.className = 'text-danger'
          }
          else {
               label_agencia.className = 'text-success'
          }
          if (data.value == '') {
               label_data.className = 'text-danger'
          }
          else {
               label_data.className = 'text-success'
          }
     }
     
}
function validarEditMat(id) {
     var form = document.getElementById('form_edit_mat'+id)
     var label_descriçao = document.getElementById('label_descriçao_edit_mat'+id)
     var descriçao = document.getElementById('descriçaoEditMat'+id)
     var qtd = document.getElementById('qtdEditMat'+id)
     var label_qtd = document.getElementById('label_qtd_edit_mat'+id)
     var btn = document.getElementById('caixa_btn_edit_mat'+id)
     var small = document.getElementById('small_edit_mat'+id)

     if (descriçao.value != '' && qtd.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'text-danger visible'
          if (descriçao.value == '') {
               label_descriçao.className = 'text-danger'
          }
          else {
               label_descriçao.className = 'text-success'
          }

          if (qtd.value == '') {
               label_qtd.className = 'text-danger'
          }
          else {
               label_qtd.className = 'text-success'
          }
     }
}

// MODAL ADD NOVA FERRAMENTA 
function validarNovaFerramenta() {
     var ferramenta = document.getElementById('ferramentaNova')
     var qtd = document.getElementById('qtdNovaFerramenta')
     var btn = document.getElementById('caixa_btn_nova_ferramenta')
     var form = document.getElementById('form_nova_ferramenta')
     var label_ferr = document.getElementById('labelNovaFerramenta')
     var label_qtd = document.getElementById('label_qtd_nova_ferramenta')
     var small = document.getElementById('small_nova_ferramenta')
     if (ferramenta.value != '' && qtd.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'visible text-danger d-block'
          if(ferramenta.value == '') {
               label_ferr.className = 'text-danger'
          }
          else {
               label_ferr.className = 'text-success'
          }
           
          if (qtd.value == '') {
               label_qtd.className = 'text-danger'
          }
          else {
               label_qtd.className = 'text-success'
          }
     }
}

// MODAL EXCLUIR FERRAMENTA 
function validarExclusaoFerramenta() {
     var ferramenta = document.getElementById('ferramentaDelete')
     var btn = document.getElementById('caixa_btn_remove_ferramenta')
     var form = document.getElementById('form_remove_ferramenta')
     var label_ferramenta = document.getElementById('label_remove_ferramenta')
     var small = document.getElementById('small_delete_ferramenta')

     if(ferramenta.value != '') {
          form.appendChild(btn)
     }
     else {
          small.className = 'visible text-danger'
          label_ferramenta.className = 'text-danger'
     }
}

// MODAL ADD FERRAMENTA
function validarAddFerramenta(id, id_ferramenta, numeroFerramentas) {     
     var auxiliar = document.getElementsByClassName('auxiliar_remove_ferrenta')  
     var small = document.getElementById('small_add_ferramenta'+id)
     var form = document.getElementById('formAdicionarFerramenta'+id_ferramenta)
     var caixa_btn = document.getElementById('caixa_btn_add_ferramenta'+id)
     
     var qtdAux = 0;     
     for (n1 = 0; n1 < numeroFerramentas; n1++ ) {          
          if(auxiliar[n1].children['0'].checked == false){ 
               qtdAux++               
          }
     }     
     if (qtdAux == numeroFerramentas) {
          small.className = 'text-danger mt-3'
     }
     else {          
          form.appendChild(caixa_btn)          
     }
}  

// REMOVER FERRAMENTA
function validarRemoveFerramenta(id) {
     var qtd = document.getElementById('qtd_remove_ferramenta'+id)
     var funcionario = document.getElementById('func_remove_ferramenta'+id)
     var btn = document.getElementById('caixa_btn_remove_ferramenta'+id)
     var form = document.getElementById('formRemoveFerramenta'+id)
     var label_qtd = document.getElementById('label_qtd_remove_ferramenta'+id)
     var label_func = document.getElementById('label_func_remove_ferramenta'+id)
     var small = document.getElementById('small_remove_ferramenta'+id)     
     var agencia = document.getElementById('agencia_remove_ferr'+id)
     var label_agencia = document.getElementById('label_agencia_remove_ferr'+id)
     var data = document.getElementById('input_date_remov_ferr'+id)
     var label_data = document.getElementById('label_data_remov_ferr'+id)
     
     if(qtd.value != '' && funcionario.value != '0' && agencia.value != '0' && data.value != '') {
          form.appendChild(btn)
     }
     else {             
          small.className = 'pl-3 pb-3 text-danger visible'
          if(qtd.value == '') {
               label_qtd.className = 'text-danger'
          }
          else {
               label_qtd.className = 'text-success'
          }

          if(funcionario.value == '0') {
               label_func.className = 'text-danger'
          }
          else {
               label_func.className = 'text-success'
          }    
          if (agencia.value == '0') {
               label_agencia.className = 'text-danger'
          }
          else {
               label_agencia.className = 'text-success'
          }
          if (data.value == '') {
               label_data.className = 'text-danger'
          }
          else {
               label_data.className = 'text-success'
          }        
     }
}

// Editar ferramenta
function validarEditFerramenta(id) {
     var qtd = document.getElementById('qtd_edit_ferramenta'+id)
     var descriçao = document.getElementById('descriçao_edit_ferramenta'+id)
     var btn = document.getElementById('caixa_btn_edit_ferramenta'+id)
     var form = document.getElementById('formEditFerramenta'+id)
     var label_qtd = document.getElementById('label_qtd_edit_ferramenta'+id)
     var label_descriçao = document.getElementById('label_descriçao_edit_ferramenta'+id)
     var small = document.getElementById('small_edit_ferramenta'+id)     
     
     if(qtd.value != '' && descriçao.value != '') {
          form.appendChild(btn)
     }
     else {             
          small.className = 'pl-3 pb-3 text-danger visible'
          if(qtd.value == '') {
               label_qtd.className = 'text-danger'
          }
          else {
               label_qtd.className = 'text-success'
          }

          if(descriçao.value == '') {
               label_descriçao.className = 'text-danger'
          }
          else {
               label_descriçao.className = 'text-success'
          }          
     }
}



// modal confirmar delete ferramenta 
function validarDeleteFerramenta(numeroFerramentas) {
     var auxiliar = document.getElementsByClassName('auxiliar_delete_ferramenta')  
     var small = document.getElementById('small_confirm_delete_ferramenta')
     var form = document.getElementById('form_confirm_delete_ferramenta')
     var caixa_btn = document.getElementById('caixa_btn_confirm_delete_ferramenta')

     var qtdAux = 0;
     for (n1 = 0; n1 < numeroFerramentas; n1++ ) {          
          if(auxiliar[n1].children['0'].checked == false) {
               qtdAux++
          }                          
     }

     if (qtdAux == numeroFerramentas) {
          small.className = 'text-danger'
     }
     else {          
          form.appendChild(caixa_btn)
          caixa_btn.className = 'modal-footer'
     }
}   



