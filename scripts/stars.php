<div class="text-dark d-inline">
    <?php  
        for ($i=0; $i < 5; $i++) { 
            //var_dump($row);
            $hvezdicka = round($row["prum"])/2;
            if ($i<$hvezdicka) 
            {
                if ($i+0.5 == $hvezdicka) 
                {
                    echo('<i class="fas fa-star-half-alt"></i>');
                }
                else
                {
                    echo('<i class="fas fa-star"></i>');
                }
            } 
            else
            {
                echo('<i class="far fa-star"></i>');
            }
        }?>
</div>