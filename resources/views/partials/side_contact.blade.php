@php
    $siteContact = \App\Support\SiteContactHelper::get();
    $tel1Clean = preg_replace('/[^0-9+]/', '', (string) ($siteContact->telepon_1 ?? '+62217942940'));
@endphp
        <!-- Hubungi Kami -->
        <div class="side-panel__content" data-content="kontak">
            <h3 class="side-panel__title">Hubungi Kami</h3>
            <ul class="panel-links">
                <li><a href="tel:{{ $tel1Clean }}" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">call</span>
                        <span>
                            <strong>Telp: {{ $siteContact->telepon_1 ?? '' }}(H){{ !empty($siteContact->telepon_2) ? ' / ' . $siteContact->telepon_2 : '' }}</strong>
                            @if (!empty($siteContact->fax))
                                <small>Fax: {{ $siteContact->fax }}</small>
                            @endif
                        </span>
                    </a></li>
                <li><a href="mailto:{{ $siteContact->email_1 ?? '' }}" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">mail</span>
                        <span>
                            <strong>{{ $siteContact->email_1 ?? '' }}</strong>
                            @if (!empty($siteContact->email_2))
                                <small>{{ $siteContact->email_2 }}</small>
                            @endif
                        </span>
                    </a></li>
                <li>
                    <div class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">location_on</span>
                        <span><strong>Sekretariat DPP</strong><small>{{ $siteContact->alamat ?? '' }}</small></span>
                    </div>
                </li>
                <li>
                    <div class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">schedule</span>
                        <span><strong>Jam Operasional</strong><small>{{ $siteContact->jam_operasional ?? '' }}</small></span>
                    </div>
                </li>
            </ul>
        </div>
