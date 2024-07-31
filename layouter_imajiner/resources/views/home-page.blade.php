<x-layout.test-layout>
    <x-header.test-header title='Insert Title Here'/>
    <link rel="stylesheet" href="{{ asset('static/home-page-resource/home-page.css') }}">

    <table class="table-auto">
        <thead>
          <tr>
            <th>Song</th>
            <th>Artist</th>
            <th>Year</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
            <td>Malcolm Lockyer</td>
            <td>1961</td>
          </tr>
          <tr>
            <td>Witchy Woman</td>
            <td>The Eagles</td>
            <td>1972</td>
          </tr>
          <tr>
            <td>Shining Star</td>
            <td>Earth, Wind, and Fire</td>
            <td>1975</td>
          </tr>
        </tbody>
    </table>

    <div class="bg-gray-950">content</div>

    <script src="{{ asset('static/home-page-resource/home-page.js') }}"></script>
    <x-footer.test-footer/>
</x-layout.test-layout>