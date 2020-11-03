# Integracao TOTVS-RM via PHP

Para que a integração via SOAP funcione, é necessário que a saida seja em XML. Sendo assim, pode ser necessário inserir a CLASS ArraytoXML no controller.

include 'ArrayToXml.php';
use Spatie\ArrayToXml\ArrayToXml;
