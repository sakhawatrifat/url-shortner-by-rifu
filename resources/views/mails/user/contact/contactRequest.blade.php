@component('mail::message')
<style type="text/css">
    .header{
        text-align:center;
    }
    tr {
        vertical-align: baseline;
    }
</style>


<table>
    <tbody>
        <tr>
            <th style="padding:20px 0px">相談依頼</th>
            <td></td>
        </tr>
        <tr>
            <th>氏名(漢字):</th>
            <td>{{$content['name_kanji']}}</td>
        </tr>
        <tr>
            <th>氏名(フリガナ):</th>
            <td>{{$content['name_furigana']}}</td>
        </tr>
        <tr>
            <th>メールアドレス:</th>
            <td>{{$content['email']}}</td>
        </tr>
        <tr>
            <th>電話番号:</th>
            <td>{{$content['phone']}}</td>
        </tr>
        <tr>
            <th>ご連絡希望時間:</th>
            <td>{{$content['desired_contact_time']}}</td>
        </tr>
        <tr>
            <th>郵便番号:</th>
            <td>{{$content['post_code_first']}} - {{$content['post_code_last']}}</td>
        </tr>
        @if(isset($content->prefecture))
            <tr>
                <th>県:</th>
                <td>
                    {{$content->prefecture['name']}}
                </td>
            </tr>
        @endif
        @if(isset($content->city))
            <tr>
                <th>市:</th>
                <td>
                    {{$content->city['name']}}
                </td>
            </tr>
        @endif
        @if(isset($content->ward))
            <tr>
                <th>区:</th>
                <td>
                    {{$content->ward['name']}}
                </td>
            </tr>
        @endif
        <tr>
            <th>道の名前:</th>
            <td>{{$content['street_name']}}</td>
        </tr>
        <tr>
            <th>ビル名:</th>
            <td>{{$content['building_name']}}</td>
        </tr>
        <tr>
            <th>相続無料相談をご希望ですか？:</th>
            <td>
                {{$content['free_inheritance_consultation_status']}}
                @if($content['free_inheritance_consultation_status'] == 'はい' && isset($content['free_inheritance_consultation']) && count($content['free_inheritance_consultation']) > 0)
                    @foreach($content['free_inheritance_consultation'] as $consultationKey => $consultationItem)
                        <span style="display:block">{{ $consultationItem }} {{count($content['free_inheritance_consultation']) != $consultationKey+1 ? ',' : ''}}</span>
                    @endforeach
                @endif
            </td>
        </tr>
        @if(isset($content->serviceCategory) && count($content->serviceCategory) > 0)
            <tr>
                <th>ご相談内容をお選びください:</th>
                <td>
                    @foreach($content->serviceCategory as $serviceKey => $serviceItem)
                        <span style="display:block">{{ $serviceItem['title'] }} {{count($content->serviceCategory) != $serviceKey+1 ? ',' : ''}}</span>
                    @endforeach
                </td>
            </tr>
        @endif
        @if(isset($content['contact_reference']) && count($content['contact_reference']) > 0)
            <tr>
                <th>ソレイユを何で知りましたか？:</th>
                <td>
                    @foreach($content['contact_reference'] as $referenceKey => $referenceItem)
                        <span style="display:block">{{ $referenceItem }} {{count($content['contact_reference']) != $referenceKey+1 ? ',' : ''}}</span>
                    @endforeach
                </td>
            </tr>
        @endif
        <tr>
            <th>お問い合わせ内容:</th>
            <td>{{$content['street_name']}}</td>
        </tr>
    </tbody>
</table>

<br><br>
<center>
    Thanks,<br>
    {{ config('app.name') }}
</center>
@endcomponent

@php
    //exit();
@endphp
