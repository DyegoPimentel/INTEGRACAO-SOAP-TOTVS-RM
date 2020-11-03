	// Inicio da integração com a TOTVS	 
	public function enviarDadosAPItotvs($cadastro){

		// Remove pontuação do CPF
		$cpf = str_replace('.','',$cadastro->cpf);
		$cpf = str_replace('-','',$cpf);

		// Remove pontuação do CPF
		$cpf_responsavel = str_replace('.','',$cadastro->cpf_responsavel_financeiro);
		$cpf_responsavel = str_replace('-','',$cpf_responsavel);
		
		
		// Correção do formato da variavel de data e hora da criação para o formato esperado pelo sistema TOTVS
		$data_criacao = new \DateTime($cadastro->dt_criacao);
		$data_criacao = $data_criacao->format('Y-m-d').'T'.$data_criacao->format('H:i:s');

		$data_atualizacao = new \DateTime($cadastro->dt_atualizacao);
		$data_atualizacao = $data_atualizacao->format('Y-m-d').'T'.$data_atualizacao->format('H:i:s');
		if (is_null($data_atualizacao))
		{
			$data_atualizacao = $data_criacao;
		}
    
    // Verifica a forma de ingresso informado pelo aluno no formulário, e converte para o idps cadastrado na totvs.
		// Forma de inscrição - Enem = 2 | Vestibular = 3 | Transferência = 2 | Segunda Graduação = 1 
    
		if ($cadastro->forma_ingresso == 'Enem') // Enem
		{
			$forma_inscricao = '2';
			$idps = '2';
		}
		if ($cadastro->forma_ingresso == 'Vestibular') // Vestibular
		{
			$forma_inscricao = '1';
			$idps = '8';
		}
		if ($cadastro->forma_ingresso == 'Transferência') // Transferência
		{
			$forma_inscricao = '2';
			$idps = '5';
		}
		if ($cadastro->forma_ingresso == 'Segunda Graduação') // Segunda Graduação
		{
			$forma_inscricao = '1';
			$idps = '6';
		}

    // Verifica o curso e o Turno e preenche a variavel $curso com o valor cadastrado na TOTVS.
    
		if ($cadastro->cursos_id == 2 && $cadastro->turno =='noturno')
		{	// Administração Noturno
			$curso = '1';
		}
		if ($cadastro->cursos_id == 3 && $cadastro->turno =='matutino')
		{	// Agronomia Matutino
			$curso = '25';
		}
		if ($cadastro->cursos_id == 3 && $cadastro->turno =='noturno')
		{	// Agronomia Matutino
			$curso = '26';
		}
		if ($cadastro->cursos_id == 4 && $cadastro->turno =='noturno')
		{	//Arquitetura e Urbanismo - Noturno
			$curso = '28';
		}
		if ($cadastro->cursos_id == 5 && $cadastro->turno =='noturno')
		{	//Biomedicina - Noturno
			$curso = '3';
		}
		if ($cadastro->cursos_id == 6 && $cadastro->turno =='noturno')
		{	//Ciências Contábeis - Noturno
			$curso = '4';
		}
		if ($cadastro->cursos_id == 7 && $cadastro->turno =='matutino')
		{	//Direito - Matutino
			$curso = '5';
		}
		if ($cadastro->cursos_id == 7 && $cadastro->turno =='noturno')
		{	//Direito - Noturno
			$curso = '6';
		}
		if ($cadastro->cursos_id == 8 && $cadastro->turno =='matutino')
		{	//Educação Física - Matutino
			$curso = '7';
		}
		if ($cadastro->cursos_id == 8 && $cadastro->turno =='noturno')
		{	//Educação Física - Noturno
			$curso = '8';
		}
		if ($cadastro->cursos_id == 11 && $cadastro->turno =='matutino')
		{	//Enfermagem - Matutino
			$curso = '9';
		}
		if ($cadastro->cursos_id == 11 && $cadastro->turno =='noturno')
		{	//Enfermagem - Noturno
			$curso = '10';
		}
		if ($cadastro->cursos_id == 13 && $cadastro->turno =='noturno')
		{	//Engenharia Ambiêntal e Sanitária - Noturno
			$curso = '30';
		}
		if ($cadastro->cursos_id == 28 && $cadastro->turno =='noturno')
		{	//Engenharia Civil - Noturno
			$curso = '31';
		}
		if ($cadastro->cursos_id == 18 && $cadastro->turno =='noturno')
		{	//Engenharia Mecânica - Noturno
			$curso = '36';
		}
		if ($cadastro->cursos_id == 19 && $cadastro->turno =='noturno')
		{	//Estética e Cosmética - Noturno
			$curso = '11';
		}
		if ($cadastro->cursos_id == 20 && $cadastro->turno =='matutino')
		{	//Farmácia - Matutino
			$curso = '12';
		}
		if ($cadastro->cursos_id == 20 && $cadastro->turno =='noturno')
		{	//Farmácia - Noturno
			$curso = '13';
		}
		if ($cadastro->cursos_id == 14 && $cadastro->turno =='noturno')
		{	//Gestão de Recursos Humanos - Noturno
			$curso = '15';
		}
		if ($cadastro->cursos_id == 12 && $cadastro->turno =='noturno')
		{	// Logística - Noturno
			$curso = '17';
		}
		if ($cadastro->cursos_id == 22 && $cadastro->turno =='matutino')
		{	// Medicina Veterinária - Matutino
			$curso = '18';
		}
		if ($cadastro->cursos_id == 23 && $cadastro->turno =='noturno')
		{	// Nutrição - Noturno
			$curso = '20';
		}
		if ($cadastro->cursos_id == 24 && $cadastro->turno =='integral')
		{	// Odontologia - Integral
			$curso = '21';
		}
		if ($cadastro->cursos_id == 25 && $cadastro->turno =='matutino')
		{	// Pedagogia - Matutino
			$curso = '22';
		}
		if ($cadastro->cursos_id == 25 && $cadastro->turno =='noturno')
		{	// Pedagogia - Noturno
			$curso = '23';
		}
		if ($cadastro->cursos_id == 10 && $cadastro->turno =='matutino')
		{	// Processos Químicos - Matutino
			$curso = '34';
		}
		if ($cadastro->cursos_id == 10 && $cadastro->turno =='noturno')
		{	// Processos Químicos - Noturno
			$curso = '35';
		}
		if ($cadastro->cursos_id == 26 && $cadastro->turno =='integral')
		{	// Psicologia - Integral
			$curso = '24';
		}
		
		
		$xml_cadastro_aluno_totvs = [
			'EduPSInscricaoUsuarioArea' => [
				'SPSINSCRICAOAREAOFERTADA' => [
					'CODCOLIGADA' => '1', // Código Fixo = 1
					'IDPS' => $idps, // Processo Seletivo 2021/1 - Online(vestibular) = 8 | Online(Enem) = 2 | Online(transferência) = 5 | Online(Segunda Graduação) = 6 
					'CODUSUARIOPS' => '0', // Código Fixo = 0 (indica que será criado um novo)
					'NUMEROINSCRICAO' => '-1', // Código Fixo = -1 (indica que será criada uma nova inscrição)
					'IDFORMAINSCRICAO' => $forma_inscricao, // Forma de inscrição - Enem = 2 | Vestibular = 3 | Transferência = 2 | Segunda Graduação = 1 (Os Valores aqui coicidem pois este campo é um campo filho ao campo IDPS)
					'DATAINSCRICAO' => $data_criacao, // Buscar a data atual do momento da inscrição
					'NUMEROCARTAORESPOSTA' => '', // Deixar vazio
					'CODMUNICIPIO' => '01108', // Deixar fixo: 01108 (Esse é o codigo referente a Anápolis, caso a FAMA crie novos Polos em outras cidades será necessário criar no banco de dados a variavel com os codigos de cidade disponibilizado pela totvs)
					'CODETDMUNICIPIO' => 'GO', // Deixar fixo: GO
					'STATUS' => '0', // Deixar fixo: 0
					'TREINEIRO' => 'F', // Deixar fixo: F
					'DEFAUDITIVA' => 'F', // Deixar fixo: F
					'DEFFISICA' => 'F', // Deixar fixo: F
					'DEFVISUAL' => 'F', // Deixar fixo: F
					'DEFMULTIPLA' => 'F', // Deixar fixo: F
					'DEFOUTRAS' => 'F', // Deixar fixo: F
					'IDCAMPUS' => '1', // Deixar fixo: 1
					'COTAFEDERAL' => 'F', // Deixar fixo: F
					'COTAFEDERALENSINOPUBLICO' => 'F', // Deixar fixo: F
					'COTAFEDERALRENDA' => 'F', // Deixar fixo: F
					'COTAFEDERALCORACA' => 'F', // Deixar fixo: F
					'DATAHORAACEITEPORTAL' => $data_atualizacao, // Incluir a data e hora da efetivação da inscrição
					'DEFFALA' => 'F', // Deixar fixo: F
					'DEFMENTAL' => 'F', // Deixar fixo: F
					'DEFINTELECTUAL' => 'F', // Deixar fixo: F
					'BRPDH' => 'F', // Deixar fixo: F
					'ENEMNUMINSCRICAO' => $cadastro->enem_n_inscricao, // $cadastro->enem_n_inscricao
					'ENEMANOREFERENCIA' => $cadastro->enem_ano,
					'ENEMNOTAREDACAO' => '-1', // $cadastro->enem_nota_redacao
					'ENEMNOTAOBJETIVA' => '-1', // $cadastro->enem_nota_objetiva
					'COTAFEDERALPCD' => 'F' // Deixar fixo: F
				],
				'SPSOPCAOINSCRITO' => [
					'CODCOLIGADA' => '1', // Código Fixo = 1
					'IDPS' => $idps, // Processo Seletivo 2021/1 - Online(vestibular) = 8 | Online(Enem) = 2 | Online(transferência) = 5 | Online(Segunda Graduação) = 6
					'CODUSUARIOPS' => '0', // Código Fixo = 0 (indica que será criado um novo)
					'NUMEROINSCRICAO' => '-1', // Código Fixo = -1 (indica que será criada uma nova inscrição)
					'IDAREAINTERESSE' => $curso, // Curso e turno
					'NUMEROOPCAO' => '1', // Código Fixo = 1
					'STATUS' => '0' // Código Fixo = 0
				],
				'SPSINSCAREAOFERTACOMPL' => [
					'CODCOLIGADA' => '1', // Código Fixo = 1
					'IDPS' => $idps, // Processo Seletivo 2021/1 - Online(vestibular) = 8 | Online(Enem) = 2 | Online(transferência) = 5 | Online(Segunda Graduação) = 6 
					'NUMEROINSCRICAO' => '-1' // Código Fixo = -1 (indica que será criada uma nova inscrição)
				],
				'SPSAceiteTermo' => [
					'CODACEITETERMO' => '3', // Código Fixo = 3
					'CODCOLIGADA' => '1', // Código Fixo = 1
					'IDPS' => $idps, // Processo Seletivo 2021/1 - Online(vestibular) = 8 | Online(Enem) = 2 | Online(transferência) = 5 | Online(Segunda Graduação) = 6 
					'IDAREAINTERESSE' => $curso, // Curso e turno
					'CODUSUARIOPS' => '0', // Código Fixo = 0 (indica que será criado um novo)
					'TEXTOTERMO' => 'Ao inscrever-me, estou ciente da importância das informações aqui descritas. Sei também que devo manter meus dados sempre atualizados, através deles poderei receber notícias durante e após o término das inscrições.', //Texto que irá aparecer no momento do aceite na página de inscrições.
					'DATAHORAACEITE' => $data_atualizacao, // Data e hora do aceite do termo.
					'TIPOCONSENTIMENTO' => '1', // Aceite SIM = 1
					'CLIENTIP' => $cadastro->ip, // IP do candidato.
					'NUMEROINSCRICAO' => '-1' // Código Fixo = -1 (indica que será criada uma nova inscrição)
				],
				'SPSUSUARIO' => [
					'CODUSUARIOPS' => '0', // Código Fixo = 0 (indica que será criado um novo)
					'NOME' => $cadastro->nome.' ', // Nome do candidato
					'DTNASCIMENTO' => $cadastro->dt_nascimento.'T00:00:00', // Data de nascimento do candidato
					'SEXO' => $cadastro->sexo, // Sexo do candidato (M = Masculino / F = Feminino)
					'RUA' => $cadastro->rua, // Endereço: RUA
					'NUMERO' => $cadastro->numero, // Endereço: Número da casa
					'BAIRRO' => $cadastro->bairro, // Endereço: Bairro
					'ESTADO' => $cadastro->uf, // Endereço: Sigla do estado do endereço do candidato.
					'CIDADE' => $cadastro->cidadeNome, // Endereço: Descrição do nome da cidade, conforme Excel enviado.
					'CEP' => $cadastro->cep, // Endereço: CEP do endereço
					'IDPAIS' => '1', // 1 = Brasil (Caso seja necessario incluir outro pais, verifique com a TOTVS o id de cada Pais.)
					'CPF' => $cpf, // CPF do candidato
					'TELEFONE2' => $cadastro->telefone, // Telefone do candidato
					'NIT' => '0', // Código Fixo = 0
					'CONJUGEBRASIL' => '0', // Código Fixo = 0
					'NATURALIZADO' => '0', // Código Fixo = 0
					'EMAIL' => $cadastro->email, // E-mail do candidato/aluno
					'NOMEPAIS' => 'Brasil', // Código Fixo: Brasil (Caso seja necessário incluir novos paises, precisa incluir esta coluna no BD.)
					'UFENDERECO' => $cadastro->uf, // Descrição do Estado do endereço do candidato
					'NOMEESTADONATAL' => '?', // Os itens acima são referentes à naturalidade.
					'IDPAISESTADONATAL' => '1', // Os itens acima são referentes à naturalidade.
					'NOMEPAISESTADONATAL' => 'Brasil', // Os itens acima são referentes à naturalidade.
					'FUMANTE' => '0', // Código Fixo: 0
					'CANHOTO' => 'F', // Código Fixo: F
					'CODCOLIGADA' => '1', // Código Fixo = 1
					'IDPS' => $idps, // Processo Seletivo 2021/1 - Online(vestibular) = 8 | Online(Enem) = 2 | Online(transferência) = 5 | Online(Segunda Graduação) = 6 
					'EHCANDIDATO' => 'T', // Código Fixo: T
					'EHRESPFIN' => 'T' // Código Fixo: T
				],
			]
		];

		$xml_cadastro_com_responsavel = '<EduPSInscricaoUsuarioArea >
		  <SPSINSCRICAOAREAOFERTADA>
		    <CODCOLIGADA>1</CODCOLIGADA>
		    <IDPS>'.$idps.'</IDPS>
		    <CODUSUARIOPS>0</CODUSUARIOPS>
		    <NUMEROINSCRICAO>-1</NUMEROINSCRICAO>
		    <IDFORMAINSCRICAO>'.$forma_inscricao.'</IDFORMAINSCRICAO>
		    <DATAINSCRICAO>'.$data_criacao.'</DATAINSCRICAO>
		    <NUMEROCARTAORESPOSTA></NUMEROCARTAORESPOSTA>
		    <CODMUNICIPIO>01108</CODMUNICIPIO>
		    <CODETDMUNICIPIO>GO</CODETDMUNICIPIO>
		    <STATUS>0</STATUS>
		    <TREINEIRO>F</TREINEIRO>
		    <DEFAUDITIVA>F</DEFAUDITIVA>
		    <DEFFISICA>F</DEFFISICA>
		    <DEFVISUAL>F</DEFVISUAL>
		    <DEFMULTIPLA>F</DEFMULTIPLA>
		    <DEFOUTRAS>F</DEFOUTRAS>
		    <IDCAMPUS>1</IDCAMPUS>
		    <COTAFEDERAL>F</COTAFEDERAL>
		    <COTAFEDERALENSINOPUBLICO>F</COTAFEDERALENSINOPUBLICO>
		    <COTAFEDERALRENDA>F</COTAFEDERALRENDA>
		    <COTAFEDERALCORACA>F</COTAFEDERALCORACA>
		    <DATAHORAACEITEPORTAL>'.$data_atualizacao.'</DATAHORAACEITEPORTAL>
		    <DEFFALA>F</DEFFALA>
		    <DEFMENTAL>F</DEFMENTAL>
		    <DEFINTELECTUAL>F</DEFINTELECTUAL>
			<BRPDH>F</BRPDH>
			<ENEMNUMINSCRICAO>'.$cadastro->enem_n_inscricao.'</ENEMNUMINSCRICAO>
			<ENEMANOREFERENCIA>'.$cadastro->enem_ano.'</ENEMANOREFERENCIA>
			<ENEMNOTAREDACAO>-1</ENEMNOTAREDACAO>
			<ENEMNOTAOBJETIVA>-1</ENEMNOTAOBJETIVA>
		    <COTAFEDERALPCD>F</COTAFEDERALPCD>
		  </SPSINSCRICAOAREAOFERTADA>
		  <SPSOPCAOINSCRITO>
		    <CODCOLIGADA>1</CODCOLIGADA>
		    <IDPS>'.$idps.'</IDPS>
		    <CODUSUARIOPS>0</CODUSUARIOPS>
		    <NUMEROINSCRICAO>-1</NUMEROINSCRICAO>
		    <IDAREAINTERESSE>'.$curso.'</IDAREAINTERESSE>
		    <NUMEROOPCAO>1</NUMEROOPCAO>
		    <STATUS>0</STATUS>
		  </SPSOPCAOINSCRITO>
		  <SPSINSCAREAOFERTACOMPL>
		    <CODCOLIGADA>1</CODCOLIGADA>
		    <IDPS>'.$idps.'</IDPS>
		    <NUMEROINSCRICAO>-1</NUMEROINSCRICAO>
		  </SPSINSCAREAOFERTACOMPL>
		  <SPSAceiteTermo>
    		    <CODACEITETERMO>3</CODACEITETERMO>
    		    <CODCOLIGADA>1</CODCOLIGADA>
    		    <IDPS>'.$idps.'</IDPS>
    		    <IDAREAINTERESSE>'.$curso.'</IDAREAINTERESSE>
    		    <CODUSUARIOPS>0</CODUSUARIOPS>
    		    <TEXTOTERMO>Ao inscrever-me, estou ciente da importância das informações aqui descritas. Sei também que devo manter meus dados sempre atualizados, através deles poderei receber notícias durante e após o término das inscrições.</TEXTOTERMO>
    		    <DATAHORAACEITE>'.$data_atualizacao.'</DATAHORAACEITE>
    		    <TIPOCONSENTIMENTO>1</TIPOCONSENTIMENTO>
    		    <CLIENTIP>'.$cadastro->ip.'</CLIENTIP>
    	         <NUMEROINSCRICAO>-1</NUMEROINSCRICAO>
  		  </SPSAceiteTermo>	  
		  <SPSUSUARIO>
			<CODUSUARIOPS>0</CODUSUARIOPS>
			<NOME>'.$cadastro->nome.' </NOME>
			<DTNASCIMENTO>'.$cadastro->dt_nascimento.'T00:00:00</DTNASCIMENTO>
			<SEXO>'.$cadastro->sexo.'</SEXO>
			<RUA>'.$cadastro->rua.'</RUA>
			<NUMERO>'.$cadastro->numero.'</NUMERO>
			<BAIRRO>'.$cadastro->bairro.'</BAIRRO>
			<ESTADO>'.$cadastro->uf.'</ESTADO>
			<CIDADE>'.$cadastro->cidadeNome.'</CIDADE>
			<CEP>'.$cadastro->cep.'</CEP>
			<IDPAIS>1</IDPAIS>
			<CPF>'.$cpf.'</CPF>
			<TELEFONE2>'.$cadastro->telefone.'</TELEFONE2>
			<NIT>0</NIT>
			<CONJUGEBRASIL>0</CONJUGEBRASIL>
			<NATURALIZADO>0</NATURALIZADO>
			<EMAIL>'.$cadastro->email.'</EMAIL>
			<NOMEPAIS>Brasil</NOMEPAIS>
			<UFENDERECO>'.$cadastro->uf.'</UFENDERECO>
			<NOMEESTADONATAL>?</NOMEESTADONATAL>
			<IDPAISESTADONATAL>1</IDPAISESTADONATAL>
			<NOMEPAISESTADONATAL>Brasil</NOMEPAISESTADONATAL>
			<FUMANTE>0</FUMANTE>
			<CANHOTO>F</CANHOTO>
			<CODCOLIGADA>1</CODCOLIGADA>
			<IDPS>'.$idps.'</IDPS>
			<EHCANDIDATO>T</EHCANDIDATO>
			<EHRESPFIN>F</EHRESPFIN>
		</SPSUSUARIO>
		<SPSUSUARIO>
 			<CODUSUARIOPS>0</CODUSUARIOPS>
 			<NOME>'.$cadastro->nome_responsavel_financeiro.' </NOME>
 			<DTNASCIMENTO>'.$cadastro->nascimento_responsavel_financeiro.'T00:00:00</DTNASCIMENTO>
 			<CPF>'.$cpf_responsavel.'</CPF>
 			<EMAIL>'.$cadastro->email_responsavel_financeiro.'</EMAIL>
 			<RUA>'.$cadastro->rua.'</RUA>
			<NUMERO>'.$cadastro->numero.'</NUMERO>
			<BAIRRO>'.$cadastro->bairro.'</BAIRRO>
			<ESTADO>'.$cadastro->uf.'</ESTADO>
			<CIDADE>'.$cadastro->cidadeNome.'</CIDADE>
			<CEP>'.$cadastro->cep.'</CEP>
			<IDPAIS>1</IDPAIS>
 			<FUMANTE>0</FUMANTE> 
 			<CANHOTO>F</CANHOTO>
 			<CODCOLIGADA>1</CODCOLIGADA>
 			<IDPS>'.$idps.'</IDPS>
 			<EHCANDIDATO>F</EHCANDIDATO>
 			<EHRESPFIN>T</EHRESPFIN>
		</SPSUSUARIO>
		</EduPSInscricaoUsuarioArea>';

		



		// Verifica a Idade do Aluno, pois se o candidato for menor de idade, é necessário informar um responsável financeiro
    // maior de idade para que seja possivel realizar o cadastro dentro do sistema da TOTVS. Caso a data de nascimento do
    // Responsável for inferior a 18 anos ou for null, o cadastro não será efetuado.
		$data_nascimento = new DateTime($cadastro->dt_nascimento);
		$data_atual = new DateTime();
		$intervalo = $data_atual->diff($data_nascimento);
		$idade = $intervalo->y;

		if ($cadastro->responsavel_financeiro == 'Nao' || $idade < 18)
		{
			$xml = new SimpleXMLElement($xml_cadastro_com_responsavel);
			$xml = $xml->asXML();
			//echo 'com responsável' ;
		}
		else {
			$xml_cadastro_totvs = $xml_cadastro_sem_responsavel;
			$xml = ArrayToXml::convert($xml_cadastro_totvs);
			//echo 'sem responsável' ;
		}

		$auth = array(
			'login'=>'INSIRA O LOGIN AQUI',
			'password'=>'INSIRA A SENHA AQUI',
			'trace' => 1,
			'exceptions'=>0
		);
		
		try {
			//Realiza a conexão com o WSDL e verifica a autenticação
			$soapclient = new \SoapClient( 'http://INSIRA AQUI A URL DO WSDL', $auth );

			// $params = array( 'DataServerName'=>'EduPSInscricaoUsuarioAreaData', 'XML'=> $xml, 'Contexto'=>'CODCOLIGADA=1,CODFILIAL=1,CODUSUARIO=INSIRA O LOGIN AQUI,CODSISTEMA=S' );
			$params = array( 'DataServerName'=>'EduPSInscricaoUsuarioAreaData', 'XML'=> $xml, 'Contexto'=>'CODCOLIGADA=1,CODFILIAL=1,CODUSUARIO=INSIRA O LOGIN AQUI,CODSISTEMA=S' );

			// Envia o DataServerName, XML, e Contexto para o SaveRecord ( Todos do tipo string )
			$soapclient->SaveRecord( $params );
			//echo $soapclient->__getTypes();
			//print_r($xml);

			echo $soapclient->__getLastResponse();
			

		} catch ( \SoapFault $e ) {
			echo 'deu erro';
		}

		
	}
	// Fim da integração com a TOTVS
