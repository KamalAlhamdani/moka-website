{{--
<style>
    /*
    h1 {
    color: #c00;
    font-family: sans-serif;
    font-size: 2em;
    margin-bottom: 0;
    }

    table {
    font-family: sans-serif;
    }
    table th,
    table td {
    padding: 0.25em 0.5em;
    text-align: left;
    }
    table th:nth-child(2),
    table td:nth-child(2) {
    text-align: right;
    }
    table td {
    background-color: #eee;
    }
    table th {
    background-color: #009;
    color: #fff;
    }

    .zigzag {
    border-collapse: separate;
    border-spacing: 0.25em 1em;
    }
    .zigzag tbody tr:nth-child(odd) {
    transform: rotate(2deg);
    }
    .zigzag thead tr,
    .zigzag tbody tr:nth-child(even) {
    transform: rotate(-2deg);
    }*/

</style>
 --}}

<style>
    table {
        border: 1px solid #ccc;
        width: 100%;
        margin: 0;
        padding: 0;
        border-collapse: collapse;
        border-spacing: 0;
    }

    table tr {
        border: 1px solid #ddd;
        padding: 5px;
    }

    table th,
    table td {
        padding: 10px;
        text-align: center;
    }

    table th {
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
    }

    @media screen and (max-width: 600px) {

        table {
            border: 0;
        }

        table thead {
            display: none;
        }

        table tr {
            margin-bottom: 10px;
            display: block;
            border-bottom: 2px solid #ddd;
        }

        table td {
            display: block;
            text-align: right;
            font-size: 13px;
            border-bottom: 1px dotted #ccc;
        }

        table td:last-child {
            border-bottom: 0;
        }

        table td:before {
            content: attr(data-label);
            float: left;
            text-transform: uppercase;
            font-weight: bold;
        }
    }

</style>

{{--
    <h1>Top England Goal Scorers</h1>

    <table class="zigzag">
    <thead>
        <tr>
        <th class="header">Player</th>
        <th class="header">Goals</th>
        <th class="header">First</th>
        <th class="header">Latest</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td>Wayne Rooney</td>
        <td>53</td>
        <td>06 Sep 2003</td>
        <td>27 Jun 2016</td>
        </tr>
        <tr>
        <td>Bobby Charlton</td>
        <td>49</td>
        <td>19 Apr 1958</td>
        <td>20 May 1970</td>
        </tr>
        <tr>
        <td>Gary Lineker</td>
        <td>48</td>
        <td>26 Mar 1985</td>
        <td>29 Apr 1992</td>
        </tr>
        <tr>
        <td>Jimmy Greaves</td>
        <td>44</td>
        <td>17 May 1959</td>
        <td>24 May 1967</td>
        </tr>
        <tr>
        <td>Michael Owen </td>
        <td>40</td>
        <td>27 May 1998</td>
        <td>12 Sep 2007</td>
        </tr>
        <tr>
        <td>Alan Shearer</td>
        <td>30</td>
        <td>19 Feb 1992</td>
        <td>20 Jun 2000</td>
        </tr>
        <tr>
        <td>Tom Finney</td>
        <td>30</td>
        <td>28 Sep 1946</td>
        <td>04 Oct 1958</td>
        </tr>
        <tr>
        <td>Nat Lofthouse</td>
        <td>30</td>
        <td>22 Nov 1950</td>
        <td>22 Oct 1958</td>
        </tr>
        <tr>
        <td>Vivian Woodward</td>
        <td>29</td>
        <td>14 Feb 1903</td>
        <td>13 Mar 1911</td>
        </tr>
        <tr>
        <td>Frank Lampard</td>
        <td>29</td>
        <td>20 Aug 2003</td>
        <td>29 May 2013</td>
        </tr>
    </tbody>
    </table>
--}}


<table>
    <thead>
        <tr>
            <th>{{ __('_moka_nav.name') }}</th>
            <th>{{ __('_moka_nav.address') }}</th>
            <th>{{ __('_moka_contact.email') }}</th>
            <th>{{ __('_moka_contact.phone') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($branches as $key => $value)
        <tr>
            <td class="branches-td name" data-label="{{-- __('_moka_nav.name') --}}">{{ $value->name }}</td>
            <td class="branches-td" data-label="{{ __('_moka_nav.address') }}">{{ $value->address }}</td>
            <td class="branches-td" data-label="{{ __('_moka_contact.email') }}">{{ $value->email }}</td>
            <td class="branches-td" data-label="{{ __('_moka_contact.phone') }}">{{ $value->phone }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<style>
@media (max-width: 600px) {
    table .branches-td.name {
        text-align: center;
        font-weight: 600;
    }
    @if(app()->getLocale() == 'ar')
    table .branches-td {
        text-align: left;
    }
    table .branches-td:before {
        float: right;
        text-align: left;
    }
    @endif
}
</style>
