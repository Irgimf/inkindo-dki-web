/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable @next/next/no-img-element */
'use client';
import { useState } from 'react';

export default function StrukturTabs({ units }: { units: any[] }) {
  // Find root units (those without parent) to be the main tabs
  const rootUnits = units.filter(u => !u.parent || typeof u.parent === 'string');
  
  const [activeTab, setActiveTab] = useState(rootUnits.length > 0 ? rootUnits[0].id : null);

  if (rootUnits.length === 0) {
    return (
      <div className="text-center py-20 text-slate-500 bg-white rounded-2xl shadow-sm border border-slate-100">
        <span className="material-symbols-outlined text-6xl mb-4 text-slate-300">group_off</span>
        <p>Data struktur organisasi belum ditambahkan di CMS.</p>
      </div>
    );
  }

  // Get active unit and its children
  const activeRoot = rootUnits.find(u => u.id === activeTab);
  const childUnits = units.filter(u => u.parent && (u.parent.id === activeTab || u.parent === activeTab));

  return (
    <div>
      {/* Tab Navigation */}
      <div className="flex flex-wrap justify-center gap-2 mb-12">
        {rootUnits.map((unit) => (
          <button
            key={unit.id}
            onClick={() => setActiveTab(unit.id)}
            className={`px-6 py-3 rounded-full font-bold transition-all ${
              activeTab === unit.id 
                ? 'bg-royal text-white shadow-lg shadow-royal/30' 
                : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'
            }`}
          >
            {unit.name}
          </button>
        ))}
      </div>

      {/* Tab Content */}
      <div className="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 min-h-[500px]">
        {activeRoot && (
          <div className="animate-fadeIn">
            {/* Render Members of the Root Unit */}
            {activeRoot.members && activeRoot.members.length > 0 && (
              <div className="mb-16">
                <h2 className="text-2xl font-bold text-slate-800 text-center mb-8 border-b pb-4">{activeRoot.name}</h2>
                <div className="flex flex-wrap justify-center gap-6">
                  {activeRoot.members.map((member: any, i: number) => (
                    <MemberCard key={i} member={member} />
                  ))}
                </div>
              </div>
            )}

            {/* Render Child Units */}
            {childUnits.length > 0 && (
              <div className="space-y-16">
                {childUnits.map(child => (
                  <div key={child.id} className="child-unit">
                    <h3 className="text-xl font-bold text-slate-700 text-center mb-8 bg-slate-50 py-3 rounded-xl border border-slate-200">{child.name}</h3>
                    {child.members && child.members.length > 0 ? (
                      <div className="flex flex-wrap justify-center gap-6">
                        {child.members.map((member: any, i: number) => (
                          <MemberCard key={i} member={member} />
                        ))}
                      </div>
                    ) : (
                      <p className="text-center text-slate-400 text-sm">Belum ada pengurus di unit ini.</p>
                    )}
                  </div>
                ))}
              </div>
            )}
            
            {(!activeRoot.members || activeRoot.members.length === 0) && childUnits.length === 0 && (
              <p className="text-center text-slate-400 py-10">Struktur ini masih kosong.</p>
            )}
          </div>
        )}
      </div>
    </div>
  );
}

function MemberCard({ member }: { member: any }) {
  return (
    <div className="group w-[260px] bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
      <div className="h-64 bg-slate-100 relative overflow-hidden">
        {member.photo?.url ? (
          <img 
            src={member.photo.url} 
            alt={member.name} 
            className="w-full h-full object-cover object-top filter grayscale group-hover:grayscale-0 transition-all duration-500"
          />
        ) : (
          <div className="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">
            <span className="material-symbols-outlined text-6xl">person</span>
          </div>
        )}
        <div className="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
      </div>
      <div className="p-5 text-center relative z-10 bg-white">
        <h4 className="font-bold text-slate-900 text-lg mb-1 leading-tight">{member.name}</h4>
        <p className="text-royal font-medium text-sm">{member.position}</p>
        {member.period && <p className="text-slate-400 text-xs mt-2">Periode {member.period}</p>}
      </div>
    </div>
  );
}
