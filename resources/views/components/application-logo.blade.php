<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => 'w-10 h-10']) }}>
    <!-- Shopping Cart Body (Pink) -->
    <ellipse cx="50" cy="65" rx="30" ry="18" fill="#ec4899" opacity="0.3"/>
    
    <!-- Cart Handle Left -->
    <path d="M 35 45 Q 20 30 15 15" stroke="#9ca3af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
    
    <!-- Cart Handle Right -->
    <path d="M 65 45 Q 80 30 85 15" stroke="#9ca3af" stroke-width="2.5" fill="none" stroke-linecap="round"/>
    
    <!-- Handle Grips -->
    <circle cx="15" cy="15" r="3" fill="#9ca3af"/>
    <circle cx="85" cy="15" r="3" fill="#9ca3af"/>
    
    <!-- Cart Base -->
    <rect x="25" y="40" width="50" height="28" rx="2" fill="none" stroke="#9ca3af" stroke-width="2"/>
    
    <!-- Cart Wheels -->
    <circle cx="32" cy="72" r="4" fill="#ec4899"/>
    <circle cx="68" cy="72" r="4" fill="#ec4899"/>
    
    <!-- Grid Lines (basket weave) -->
    <line x1="30" y1="45" x2="30" y2="60" stroke="#9ca3af" stroke-width="1.5"/>
    <line x1="38" y1="45" x2="38" y2="60" stroke="#9ca3af" stroke-width="1.5"/>
    <line x1="46" y1="45" x2="46" y2="60" stroke="#9ca3af" stroke-width="1.5"/>
    <line x1="54" y1="45" x2="54" y2="60" stroke="#9ca3af" stroke-width="1.5"/>
    <line x1="62" y1="45" x2="62" y2="60" stroke="#9ca3af" stroke-width="1.5"/>
    <line x1="70" y1="45" x2="70" y2="60" stroke="#9ca3af" stroke-width="1.5"/>
    
    <line x1="25" y1="50" x2="75" y2="50" stroke="#9ca3af" stroke-width="1.5"/>
    <line x1="25" y1="55" x2="75" y2="55" stroke="#9ca3af" stroke-width="1.5"/>
    
    <!-- Heart in Cart (Logo Badge) -->
    <g transform="translate(50, 52)">
        <path d="M 0 4 C -3 0 -6 0 -6 -3 C -6 -5 -4 -6 -2 -6 C 0 -6 2 -5 2 -3 C 2 -5 4 -6 6 -6 C 8 -6 10 -5 10 -3 C 10 0 7 4 2 7 C -1 4 -6 0 -6 -3 Z" 
              fill="#ec4899" transform="scale(0.8)"/>
    </g>
    
    <!-- decorative hearts floating -->
    <circle cx="20" cy="28" r="1.5" fill="#ec4899" opacity="0.6"/>
    <circle cx="80" cy="32" r="1.2" fill="#ec4899" opacity="0.5"/>
    <circle cx="75" cy="20" r="1.5" fill="#ec4899" opacity="0.7"/>
</svg>
