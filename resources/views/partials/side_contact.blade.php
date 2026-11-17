@php
    $siteContact = \App\Support\SiteContactHelper::get();
@endphp
        <!-- Hubungi Kami -->
        <div class="side-panel__content" data-content="kontak">
            <h3 class="side-panel__title">Hubungi Kami</h3>
            <ul class="panel-links">
                <li>
                    <div class="panel-link panel-link--hover">
                        <span class="material-symbols-outlined panel-link__icon">call</span>
                        <span>
                            <strong>Telp: {{ $siteContact->telepon_1 ?? '' }}(H){{ !empty($siteContact->telepon_2) ? ' / ' . $siteContact->telepon_2 : '' }}</strong>
                            @if (!empty($siteContact->fax))
                                <small>Fax: {{ $siteContact->fax }}</small>
                            @endif
                        </span>
                    </div>
                </li>
                <li>
                    <div class="panel-link panel-link--hover">
                        <span class="material-symbols-outlined panel-link__icon">mail</span>
                        <span>
                            <strong>{{ $siteContact->email_1 ?? '' }}</strong>
                            @if (!empty($siteContact->email_2))
                                <small>{{ $siteContact->email_2 }}</small>
                            @endif
                        </span>
                    </div>
                </li>
                <li>
                    <a href="https://maps.app.goo.gl/eXnagmAbzf1ki3rw8" target="_blank" rel="noopener noreferrer" class="panel-link">
                        <span class="material-symbols-outlined panel-link__icon">location_on</span>
                        <span><strong>Sekretariat DPP</strong><small>{{ $siteContact->alamat ?? '' }}</small></span>
                    </a>
                </li>
                <li>
                    <div class="panel-link panel-link--hover">
                        <span class="material-symbols-outlined panel-link__icon">schedule</span>
                        <span><strong>Jam Operasional</strong><small>{{ $siteContact->jam_operasional ?? '' }}</small></span>
                    </div>
                </li>
            </ul>
        </div>
