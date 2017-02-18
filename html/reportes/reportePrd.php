<?php

require('views/fpdf181/fpdf.php');

class PDF extends FPDF
{
	// Cabecera de página
	function Header()
	{
	    /**
	     * Imprime una imagen en la página. Los formatos admitidos son JPEG, PNG y GIF.
	     * @param FILE: Nombre del archivo que contiene la imagen.
	     * @param X: Abscisa de la esquina superior izquierda. Si no se especifica o es igual a null.
	     * @param Y: Ordenada de la esquina superior izquierda. Si no se especifica o es igual a null.
	     * @param W: Ancho de la imagen en la página.
	     * @param H: Alto de la imagen en la página.
	     */
	    $this->Image(APP_URL.'views/images/home/logo.png',10,8,30);

	    /**
		 * Establece la fuente usada para imprimir cadenas de carácteres. 
		 * @param Family
		 * @param Style 'B': bold. 'I': italic. 'U': underline 
		 * @param Size: Tamaño de fuente en puntos. 
		 */
		$this->SetFont('Arial','B',16);

		/**
		 * Imprime una celda 
		 * @param Width:  Si es 0, la celda se extiende hasta la márgen derecha. 
		 * @param Height: Valor por defecto: 0. 
		 * @param String: cadena a ser impresa. Valor por defecto: cadena vacia.  
		 * @param Border: Indica si los bordes deben se dibujados alrededor de la celda. Puede ser 1 o 0. 
		 *        O la inicial del borde a dibujar ['L': Izquierda, 'T': superior, 'R': derecha, 'B': inferior]
		 * @param LN: Indica donde la posición actual, debería ir antes de invocar. 
		 *        0: a la derecha, 1: al comienzo de la siguiente línea, 2: debajo.
		 * @param align: Permite centrar o alinear el texto. ['L': Izquierda, 'C': centro, 'R': derecha]
		 */
		$this->Cell(0,10,'Listado de Productos al '.date('d/m/Y'),0,0,'C');

	    // Salto de línea a 20pt
	    $this->Ln(20);
	}

	// Pie de página
	function Footer()
	{
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);

	    // Establecemos la fuente del paginado
	    $this->SetFont('Arial','B',9);

	    // Usuario que Imprime el Reporte.
	    $db   = new Conexion();
	    $sql  = $db->query("SELECT name FROM users WHERE id='$_SESSION[app_id]' LIMIT 1 ;");
	    $user = $db->recorrer($sql)[0];
	    $this->Cell(1,10,utf8_decode("Impreso por: ").$user,0,0,'L');

	    // Número de página. Usamos la funcion utf8_decode para colocar acentos.
	    $this->Cell(0,10,$this->PageNo().' / {nb}',0,0,'C');

	    // Número de página. Usamos la funcion utf8_decode para colocar acentos.
	    $this->Cell(0,10,date('l H:i a'),0,0,'R');
	    $db->liberar($sql);
	    $db->close();
	}


	// Cargar los datos del txt para mostrar en la tabla
	function LoadData($file){
	    // Leer las líneas del fichero
	    $lines = file($file);
	    $data = array();
	    foreach($lines as $line)
	        $data[] = explode(';',trim($line));
	    return $data;
	}


	/**
	 * [FancyTable Funcion para crear una Tabla con colores ]
	 * @param [Array] $header [Cabecera de la tabla]
	 * @param [Array] $data   [valores de la tabla]
	 */
	function FancyTable($header, $data){
	    // Color de Fondo de Encabezado en RGB
	    $this->SetFillColor(0,132,156);

	    //Color de Letra de Encabezado
	    $this->SetTextColor(255);

	    //Color de Bordes de Celdas
	    $this->SetDrawColor(159);

	    //Ancho del Borde de las Celdas
	    $this->SetLineWidth(.2);

	    //Estilo de letra de encabezado
	    $this->SetFont('','B');

	    // Cabecera
	    $w = array(10, 75, 27, 30, 30, 27, 27, 27);
	    for($i = 0;$i < count($header);$i++)
	        $this->Cell($w[$i],9,$header[$i],1,0,'C',true);
	    $this->Ln();

	    // Restauración de colores y fuentes
	    $this->SetFillColor(224,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');

	    // Datos
	    $fill = false;
	    $db   = new Conexion();
	    $sql  ="
			SELECT
				p.id,
				p.nombre,
				p.precio,
				c.nombre,
				s.nombre,
				p.cantidad,
				p.oferta,
				p.precio_oferta
			FROM
				productos p
			JOIN
				categorias c
			ON
				c.id = p.id_categoria
			JOIN
				subcategorias s
			ON
				s.id = p.id_subcategoria
			ORDER BY
				c.nombre, p.nombre;";
		$consulta=$db->query($sql);
		$this->SetFont('Arial','B',10);
		while ($row = $consulta->fetch_row()) {
	        $this->Cell($w[0],8,number_format($row[0],0),'LR',0,'C',$fill);
	        $this->Cell($w[1],8,substr(utf8_decode($row[1]),0,39),'LR',0,'L',$fill);
	        $this->Cell($w[2],8,number_format($row[2],2,",","."),'LR',0,'R',$fill);
	        $this->Cell($w[3],8,$row[3],'LR',0,'C',$fill);
	        $this->Cell($w[4],8,$row[4],'LR',0,'C',$fill);
	        $this->Cell($w[5],8,number_format($row[5]),'LR',0,'C',$fill);
	        $oferta = ($row[6] == 1) ? "Si" : "No";
	        $this->Cell($w[6],8,$oferta,'LR',0,'C',$fill);
	        $this->Cell($w[7],8,number_format($row[7],2,",","."),'LR',0,'R',$fill);
	        $this->Ln();
	        $fill = !$fill;
	    }
	    // Línea de cierre
	    $this->Cell(array_sum($w),0,'','T');

	    //Salto de Línea de 20pt
	    $this->Ln(20);

	    //Seteamos el tipo de letra
	    $this->SetFont('Arial','B',11);

	    //Consulta para obtener total productos y suma de productos en almacen.
	    $sql 	= $db->query("
	    	SELECT 
	    		COUNT(*), 
	    		SUM(cantidad),
	    		SUM(precio * cantidad)
	    	FROM 
	    		productos 
	    	WHERE 
	    		cantidad > 0;");
	    $total  = $db->recorrer($sql);
	    $this->Cell(0,20,'Total de Productos: '.number_format($total[0],0,",","."),0,0,'L');
	    $this->Ln(5);
	    $this->Cell(0,20,'Cantidad Articulos: '.number_format($total[1],0,",","."),0,0,'L');
	    $this->Ln(5);
	    $this->Cell(0,20,'Capital en Inventario: '.number_format($total[2],2,",",".").' '.MONEDA,0,0,'L');
	    $db->liberar($sql);
	    $db->close();
	}
}

/**
 * Creamos el constructor de la Clase.
 * @var P 	[Orientación de página: "P" o Portrait (Vertical/Normal), "L" o Landscape (Horizontal)] 
 * @var mm 	[Unidad de medida: "pt": punto. "mm": milimetro. "cm": centimetro. "in": pulgada] 
 * @var mm 	[El formato usado por las páginas: "A3". "A4". "A5". "Letter". "Legal"] 
 * @return pdf
 */
$pdf = new PDF('L','mm','Letter');


/**
 * Define un alias para el número total de páginas. Se sustituira en el momento que el documento se cierre. 
 */
$pdf->AliasNbPages();


//Crea la página
$pdf->AddPage();

/**
 * SetMargins(float left, float top [, float right])
 * Define los márgenes izquierdo, superior, y derecho. Por defecto, son iguales a 1 cm.
 */
/*$pdf->SetMargins(20,20,20);*/

/**
 * Establece la fuente usada para imprimir cadenas de carácteres. 
 * @param Family
 * @param Style 'B': bold. 'I': italic. 'U': underline 
 * @param Size: Tamaño de fuente en puntos. 
 */
$pdf->SetFont('Arial','B',16);

$pdf->ln(10);
// Títulos de las columnas
$header = array(utf8_decode('Id'), 'Nombre', utf8_decode('Precio'), utf8_decode('Categoría'), utf8_decode('Subctg.'), 'Cantidad', utf8_decode('¿Oferta?'), utf8_decode('P. Oferta'));

// Carga de datos
$data = $pdf->LoadData('views/fpdf181/tutorial/paises.txt');
$pdf->FancyTable($header,$data);

/**
 * Envía el documento a un destino dado: una cadena, un fichero local o al navegador. 
 * En el último caso, puede utilizarse la extensión -plug in- (si existe) o forzarse un cuadro de diálogo de descarga.
 * El método invoca ante todo a Close() si es necesario cerrar el documento. 
 * @param (destino,nombre de archivo,es UTF-8)
 * @param destino: El valor por defecto es I.
 * I: envía el fichero al navegador de forma que se usa la extensión (plug in) si está disponible.
 * D: envía el fichero al navegador y fuerza la descarga del fichero con el nombre especificado por name.
 * F: guarda el fichero en un fichero local de nombre name.
 * S: devuelve el documento como una cadena.
 * @param nombre: El nombre del fichero. Éste es ignorado en caso de destino S. El valor por defecto es doc.pdf.
 * @param UTF-8: Bolean. Indica si name es codificado en ISO-8859-1 (false) ó UTF-8 (true). Solo usa destinos I y D. 
 */
$pdf->Output('I','Inventario_al_'.date('d/m/Y').'.pdf',true);
?>