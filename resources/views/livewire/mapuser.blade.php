<div>
    <div class="bg-gray-500 text-white p-2">Map users</div>
    <div class="p-2">
    <input type="text" class="my-1 rounded-md mb-2" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
        <table id="myTable" class="w-full">
                <tr class="w-full text-sm text-left text-white bg-gray-500">
                    <th class="text-left">CMO</th>
                    <th class="text-left">SMO</th>
                    <th class="text-left">ANM</th>
                    <th class="text-left">ASHA</th>
                    <th class="text-left">VILLAGE</th>
                </tr>
            @foreach($allmap as $map)
            <tr class="hover:bg-gray-100">
                <td class="text-left py-2 ">{{$map->cmo->name??"NA"}}</td>
                <td class="text-left py-2 ">{{$map->smo->name??"NA"}}</td>
                <td class="text-left py-2 ">{{$map->anm->name??"NA"}}</td>
                <td class="text-left py-2 ">{{$map->asha->name??"NA"}}</td>
                <td class="text-left py-2 ">{{$map->village->name??"NA"}}</td>
                
            </tr>
            @endforeach
        </table>
    
       <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr,tbody, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
 
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td0 = tr[i].getElementsByTagName("td")[0];
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    if (td0) {
      txtValue0 = td0.textContent || td0.innerText;
      txtValue1 = td1.textContent || td1.innerText;
      txtValue2 = td2.textContent || td2.innerText;
      txtValue3 = td3.textContent || td3.innerText;
      txtValue4 = td4.textContent || td4.innerText;
      if ((txtValue0.toUpperCase().indexOf(filter) > -1)
      || (txtValue1.toUpperCase().indexOf(filter) > -1)
      || (txtValue2.toUpperCase().indexOf(filter) > -1)
      || (txtValue3.toUpperCase().indexOf(filter) > -1)
      || (txtValue4.toUpperCase().indexOf(filter) > -1)
      ) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
    </div>
</div>
