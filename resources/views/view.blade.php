<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Просмотреть маршрут') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <?php
                function distance($lat_1, $lon_1, $lat_2, $lon_2) {
                    $radius_earth = 6371; // Радиус Земли
                    $lat_1 = deg2rad($lat_1);
                    $lon_1 = deg2rad($lon_1);
                    $lat_2 = deg2rad($lat_2);
                    $lon_2 = deg2rad($lon_2);
                    $d = 2 * $radius_earth * asin(sqrt(sin(($lat_2 - $lat_1) / 2) ** 2 + cos($lat_1) * cos($lat_2) * sin(($lon_2 - $lon_1) / 2) ** 2));
                    return number_format($d, 2, '.', '').' км.';
                }
                $address_1 = $task->description;
                $address_2 = $task->description2;
                $ch = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey=KEYKEYKEY&format=json&geocode=' . urlencode($address_1));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HEADER, false);
                $res = curl_exec($ch);
                curl_close($ch);
                $res = json_decode($res, true);
                $coordinates = $res['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
                $coordinates = explode(' ', $coordinates);
                $shir_1 = $coordinates[1];
                $dolg_1 = $coordinates[0];

                $ch1 = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey=KEYKEYKEY&format=json&geocode=' . urlencode($address_2));
                curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch1, CURLOPT_HEADER, false);
                $res1 = curl_exec($ch1);
                curl_close($ch1);
                $res1 = json_decode($res1, true);
                $coordinates1 = $res1['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
                $coordinates1 = explode(' ', $coordinates1);
                $shir_2 = $coordinates1[1];
                $dolg_2 = $coordinates1[0];


                echo 'Маршрут между '.$address_1.' и '.$address_2;
                echo '<br>Расстояние: '.distance($shir_1, $dolg_1, $shir_2, $dolg_2);
                ?>
                    <br><br>Стартовая точка:
                    <div class="form-group">
                        {{$task->description }}
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q={{$task->description }}&amp;aq=0&amp;oq=199+ch&amp;ie=UTF8&amp;hq=&amp;&amp;t=m&amp;z=9&amp;output=embed"></iframe>
                    </div>
                    <br>Конечная точка:
                    <div class="form-group">
                        {{$task->description2 }}
                        @if ($errors->has('description2'))
                            <span class="text-danger">{{ $errors->first('description2') }}</span>
                        @endif
                        <iframe width="250" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q={{$task->description2 }}&amp;aq=0&amp;oq=199+ch&amp;ie=UTF8&amp;hq=&amp;&amp;t=m&amp;z=9&amp;output=embed"></iframe>
                    </div>

                    <div class="form-group">
                        <br><a href="/dashboard/" name="view" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Вернуться</a></div>
                    </div>
                    {{ csrf_field() }}
            </div>
        </div>
    </div>
</x-app-layout>
