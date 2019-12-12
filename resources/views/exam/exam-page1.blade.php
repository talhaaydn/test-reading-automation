<table class="table table-hover" id="page1" style="display: none">
    <tbody>
        <tr>
            <th>Numara</th>
            <th>Ad Soyad</th>                            
            @for ($i = 0, $index = 1; $i < count($examResults[0]['answers']); $i++)
                <th><b>Soru - {{ $index++ }}</b></th>
            @endfor
            <th>Puan</th>
        </tr>

        @foreach ($examResults as $key => $item)
            @if (!isset($item['number']))
                <tr>
                    <td>ORTALAMA</td>                              
                    <td></td>   
                    
                    @for ($i = 0; $i < count($examResults['average']); $i++)
                        <td>{{ $examResults['average'][$i] }}</td> 
                    @endfor

                    <td></td>                                                             
                </tr>
            @else
                <tr>
                    <td>{{ $item['number'] }}</td>                              
                    <td>{{ $item['name'] }} {{ $item['surname'] }}</td>   
                    
                    @foreach ($item['answers'] as $answer)
                        <td>{{ $answer }}</td>                         
                    @endforeach

                    <td>{{ $item['score'] }}</td>                                                             
                </tr> 
            @endif                       
        @endforeach
    </tbody>
</table>