# Integracao TOTVS-RM via PHP

Para que a integração via SOAP funcione, é necessário que a saida seja em XML. Sendo assim, pode ser necessário inserir a CLASS ArraytoXML no controller.

<pre>include 'ArrayToXml.php';
use Spatie\ArrayToXml\ArrayToXml;</pre>

Com esta integração, assim que o candidato ao vestibular finaliza sua inscrição na landing page, seus dados são automaticamente inseridos no sistema de gestão RM TOTVS.

Essa integração foi criada para Faculdade Metropolitana de Anápolis - FAMA, no segundo semestre de 2020. 
