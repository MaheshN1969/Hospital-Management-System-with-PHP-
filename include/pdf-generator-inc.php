<?php

	require "../fpdf/fpdf.php";
	
	function generateRecord($Pfullname, $gender, $age, $bg, $Dfullname, $special, $symtoms, $prescribe, $suggest){

		if(empty($symtoms)){
			$symtoms = "-";
		}
		if(empty($prescribe)){
			$prescribe = "-";
		}
		if(empty($suggest)){
			$suggest = "-";
		}

		$pdf=new FPDF('L','mm','A4');
		$pdf->AddPage();

		// Header section
			//set font to arial,bold,14pt
			$pdf->SetFont('Times','B',24);
			$pdf->SetFillColor(245,245,245);

			$pdf->Cell(0,15,'Medical Record',0,0,'C',true);
			$pdf->Ln(5);
			$pdf->SetLineWidth(1);
			$pdf->SetDrawColor(0,0,255);
			$pdf->Line(10.5, 25, 286.5, 25);

			$pdf->Ln(12);
		
		
		$context_len = $pdf->GetStringWidth("Specialization") + 3;
		if($pdf->GetStringWidth($Pfullname) >= $pdf->GetStringWidth($Dfullname))
			$data_len = $pdf->GetStringWidth(": ".$Pfullname) + 10;
		else
			$data_len = $pdf->GetStringWidth(": ".$Dfullname) + 10;

		// data section
			// pat info

				//name and gender row
					$pdf->SetFont('Times','B',16);
					$pdf->SetLineWidth(0.2);
					$pdf->SetDrawColor(0,0,0);
					$pdf->SetFillColor(255,255,255);

					$pdf->Cell($context_len,10,'Name',0,0,'L');
					$pdf->SetFont('');
					$pdf->Cell($data_len,10,': '.$Pfullname,0,0);

					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Gender',0,0,'L');
					$pdf->SetFont('');
					$pdf->Cell($data_len,10,': '.$gender,0,1);

				// blood grp and age rows

					$pdf->SetFont('Times','B',16);
					$pdf->SetLineWidth(0.2);
					$pdf->SetDrawColor(0,0,0);
					$pdf->SetFillColor(255,255,255);

					$pdf->Cell($context_len,10,'Age',0,0,'L');
					$pdf->SetFont('');
					$pdf->Cell($data_len,10,': '.$age,0,0);

					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Blood Group',0,0,'L');
					$pdf->SetFont('');
					$pdf->Cell($data_len,10,': '.$bg,0,1);
					$pdf->Ln(5);

				$pdf->SetDrawColor(179,179,179);

				$pdf->Line(10.5, 48, 286.5, 48);
				$pdf->SetDrawColor(0,0,0);

			// doc details

				//name row
					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Dr. Name',0,0,'L');
					$pdf->SetFont('');
					$pdf->Cell(0,10,': '.$Dfullname,0,1);

				//specialization and date 
					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Specialization',0,0,'L');
					$pdf->SetFont('');
					$pdf->Cell($data_len,10,': '.$special,0,0);
					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Date',0,0,'L');
					$pdf->SetFont('');
					$pdf->Cell($data_len, 10,': '.date('d M Y'),0,0);
					$pdf->Ln(10);

				//line section
				$pdf->SetDrawColor(102,102,102);
				$pdf->SetLineWidth(1);

				$pdf->Line(10.5, 73, 286.5, 73);
				$pdf->SetDrawColor(0,0,0);

				$pdf->Ln(10);

		$context_len = $pdf->GetStringWidth("Prescriptions") + 10;
			// details section
				
				// details header
					$pdf->SetFont('Times','B',20);
					$pdf->SetFillColor(245,245,245);
			
					$pdf->Cell(0,15,'Details',0,0,'C',true);
					$pdf->Ln(5);

					$pdf->SetLineWidth(0.6);
					$pdf->SetDrawColor(255,173,51);
					$pdf->Line(10.5, 82, 286.5, 82);
					$pdf->Ln(10);

				// line property
					$pdf->SetDrawColor(179,179,179);
					$pdf->SetLineWidth(0.2);
				// symptoms section
					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Symptoms',0,0,'L');
					$pdf->SetFont('');
					$pdf->MultiCell(0,10,$symtoms,0,1);

				// draw line
					$pdf->Line(10.5, $pdf->GetY(), 286.5, $pdf->GetY());
				// prescription section
					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Prescriptions',0,0,'L');
					$pdf->SetFont('');
					$pdf->MultiCell(0,10,$prescribe,0,1);
				// draw line
					$pdf->Line(10.5, $pdf->GetY(), 286.5, $pdf->GetY());
				// suggestion section
					$pdf->SetFont('Times','B',16);
					$pdf->Cell($context_len,10,'Suggestions',0,0,'L');
					$pdf->SetFont('');
					$pdf->MultiCell(0,10,$suggest,0,1);
			// line section
			$pdf->SetLineWidth(0.6);
			$pdf->SetDrawColor(255,173,51);
			$pdf->Line(10.5, $pdf->GetY(), 286.5, $pdf->GetY());
		// footer section

		$temp_file = $special.'_'.date("d M Y_G.i:s", time());
		$filename='\\'.$temp_file.'.pdf';
		$dir='docs-pdf';
		ob_get_clean();
		$pdf->Output('F', $dir.$filename, true);
		return($dir.$filename);
	}
	