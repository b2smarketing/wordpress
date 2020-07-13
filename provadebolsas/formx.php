<form class="c-form d-flex flex-wrap" method="post" action="javascript:void(0);">
    <div class="col-md-6">
        <input type="text" class="c-form__input input-cont-textarea" name="nome" id="nome" placeholder="Nome" autocomplete="off" autocorrect="off" spellcheck="false" required>
    </div>
    <div class="col-md-6">
        <input type="text" class="c-form__input input-cont-textarea" name="sobrenome" id="sobrenome" autocomplete="off" autocorrect="off" spellcheck="false" placeholder="Sobrenome" required>
    </div>
    <div class="col-md-6">
        <input type="email" class="c-form__input input-cont-textarea" name="email" id="email" placeholder="E-mail" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
    </div>
    <div class="col-md-6">
        <input type="tel" class="c-form__input input-cont-textarea" name="cpf" id="cpf" placeholder="CPF" required>
    </div>
    <div class="col-md-6">
        <input type="tel" class="c-form__input input-cont-textarea" name="celular" id="celular" placeholder="WhatsApp" required>
    </div>
    <div class="col-md-6">
<!--         <input type="text" class="c-form__input input-cont-textarea" name="dataView" placeholder="Data" value="26/01 - 09:00" readonly>
        <input type="text" class="d-none" name="data" id="data" placeholder="Data" value="26/01" readonly>
 -->
        <select class="c-form__select input-cont-textarea" name="data" id="data" required style="text-align-last:center;">
            <option value="">Data e horário de prova</option>
            <option value="25/04 Sábado às 9h">25/04 Sábado às 9h</option>
            <option value="24/05 Domingo Às 9h">24/05 Domingo Às 9h</option>
            <option value="27/06 Sábado às 9h">27/06 Sábado às 9h</option>
            <option value="26/07 Domingo às 9h">26/07 Domingo às 9h</option>
        </select>

    </div>
    <div class="col-md-6" style="display: none;">
        <select class="c-form__select input-cont-textarea" id="curso" required>
            <option value="">Escolha um curso</option>
            <option value="Administração">Administração</option>
            <option value="Administração [MANHÃ]">Administração [MANHÃ]</option>
            <option value="Biomedicina">Biomedicina</option>
            <option value="Ciências Contábeis">Ciências Contábeis</option>
            <option value="Ciência da Computação">Ciência da Computação</option>
            <option value="Comunicação Social - Publicidade e Propaganda">Comunicação Social - Publicidade e Propaganda</option>
            <option value="Direito">Direito</option>
            <option value="Direito [MANHÃ]">Direito [MANHÃ]</option>
            <option value="Educação Física - Bacharelado">Educação Física - Bacharelado</option>
            <option value="Educação Física Bacharelado [MANHÃ]">Educação Física Bacharelado [MANHÃ]</option>
            <option value="Educação Física - Licenciatura">Educação Física - Licenciatura</option>
            <option value="Enfermagem">Enfermagem</option>
            <option value="Enfermagem [MANHÃ]">Enfermagem [MANHÃ]</option>
            <option value="Engenharia Ambiental">Engenharia Ambiental</option>
            <option value="Engenharia Civil">Engenharia Civil</option>
            <option value="Engenharia de Controle e Automação">Engenharia de Controle e Automação</option>
            <option value="Engenharia Elétrica">Engenharia Elétrica</option>
            <option value="Engenharia Mecânica">Engenharia Mecânica</option>
            <option value="Engenharia de Produção">Engenharia de Produção</option>
            <option value="Engenharia Química">Engenharia Química</option>
            <option value="Farmácia">Farmácia</option>
            <option value="Farmácia [MANHÃ]">Farmácia [MANHÃ]</option>
            <option value="Fisioterapia">Fisioterapia</option>
            <option value="Fisioterapia [MANHÃ]">Fisioterapia [MANHÃ]</option>
            <option value="Medicina Veterinária [MANHÃ]">Medicina Veterinária [MANHÃ]</option>
            <option value="Medicina Veterinária [NOITE]">Medicina Veterinária [NOITE]</option>
            <option value="Nutrição">Nutrição</option>
            <option value="Nutrição [MANHÃ]">Nutrição [MANHÃ]</option>
            <option value="Pedagogia">Pedagogia</option>
            <option value="Pedagogia [MANHÃ]">Pedagogia [MANHÃ]</option>
            <option value="Psicologia">Psicologia</option>
            <option value="Psicologia [MANHÃ]">Psicologia [MANHÃ]</option>
            <option value="Sistemas de Informação">Sistemas de Informação</option>
            <option value="Tecnologia em Design Gráfico">Tecnologia em Design Gráfico</option>
            <option value="Tecnologia em Estética e Cosmética">Tecnologia em Estética e Cosmética</option> 
            <option value="Tecnologia em Gestão de Recursos Humanos">Tecnologia em Gestão de Recursos Humanos</option>
            <option value="Tecnologia em Gestão Financeira">Tecnologia em Gestão Financeira</option>
            <option value="Tecnologia em Gestão Hospitalar">Tecnologia em Gestão Hospitalar</option>
            <option value="Tecnologia em Logística">Tecnologia em Logística</option>
            <option value="Tecnologia em Logística [MANHÃ]">Tecnologia em Logística [MANHÃ]</option>
            <option value="Tecnologia em Marketing">Tecnologia em Marketing</option>
            <option value="Tecnologia em Petróleo e Gás">Tecnologia em Petróleo e Gás</option>
            <option value="Tecnologia em Produção Audiovisual">Tecnologia em Produção Audiovisual</option>
            <option value="Tecnologia em Redes de Computadores">Tecnologia em Redes de Computadores</option>
        </select>
    </div>
    <div class="col-md-12">
        <button type="submit" id="enviar" class="c-form__btn" style="border-radius: 0px;">Concluir inscrição</button>
    </div>

    <div id="result"></div>
    <div id="error"></div>
</form> 

