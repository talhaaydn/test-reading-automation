<table class="table table-hover" id="page2" style="display: none">
    <tbody>
        <tr>
            <th>Soru Numarası</th>
            <th>Ortalaması (Puan)</th>
            <th>Başarımı (%)</th>
        </tr>

        @foreach ($examResults['average'] as $key => $average)
            <tr>
                <td>Soru {{ ++$key }}</td>       
                <td>{{ $average }}</td> 
                <td>{{ (($average / ( 100/count($examResults['average']) ))*100) }}</td>                                                             
            </tr>                     
        @endforeach
    </tbody>
</table>