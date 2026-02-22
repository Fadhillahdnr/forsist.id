<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => 'w-10 h-10']) }}>
    <defs>
        <linearGradient id="cartGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#ec4899;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#db2777;stop-opacity:1" />
        </linearGradient>
    </defs>
    
    <!-- Cart Handle Left (Pink) -->
    <path d="M 40 55 Q 20 30 15 10" stroke="#db2777" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    
    <!-- Cart Handle Right (Pink) -->
    <path d="M 80 55 Q 100 30 105 10" stroke="#db2777" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    
    <!-- Handle Grips Left -->
    <circle cx="15" cy="10" r="4" fill="#db2777"/>
    
    <!-- Handle Grips Right -->
    <circle cx="105" cy="10" r="4" fill="#db2777"/>
    
    <!-- Cart Body (Main Rectangle) -->
    <rect x="30" y="50" width="60" height="35" rx="3" fill="url(#cartGradient)" opacity="0.9"/>
    
    <!-- Cart Body Outline -->
    <rect x="30" y="50" width="60" height="35" rx="3" fill="none" stroke="#db2777" stroke-width="2.5"/>
    
    <!-- Basket Grid Lines (Vertical) -->
    <line x1="38" y1="50" x2="38" y2="85" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    <line x1="46" y1="50" x2="46" y2="85" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    <line x1="54" y1="50" x2="54" y2="85" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    <line x1="62" y1="50" x2="62" y2="85" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    <line x1="70" y1="50" x2="70" y2="85" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    <line x1="78" y1="50" x2="78" y2="85" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    
    <!-- Basket Grid Lines (Horizontal) -->
    <line x1="30" y1="60" x2="90" y2="60" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    <line x1="30" y1="70" x2="90" y2="70" stroke="#ffffff" stroke-width="1.5" opacity="0.6"/>
    
    <!-- Left Wheel -->
    <circle cx="38" cy="92" r="5" fill="#db2777" stroke="#db2777" stroke-width="1.5"/>
    <circle cx="38" cy="92" r="3" fill="none" stroke="#ffffff" stroke-width="1" opacity="0.7"/>
    
    <!-- Right Wheel -->
    <circle cx="82" cy="92" r="5" fill="#db2777" stroke="#db2777" stroke-width="1.5"/>
    <circle cx="82" cy="92" r="3" fill="none" stroke="#ffffff" stroke-width="1" opacity="0.7"/>
    
    <!-- Heart Badge (Center) -->
    <g transform="translate(60, 67)">
        <path d="M 0 5 C -4 1 -8 1 -8 -2 C -8 -5 -5 -7 -2 -7 C 0 -7 2 -5 2 -2 C 2 -5 4 -7 6 -7 C 9 -7 12 -5 12 -2 C 12 1 8 5 2 10 C -2 5 -8 1 -8 -2 Z" 
              fill="#ffffff" opacity="0.9"/>
    </g>
    
    <!-- Decorative floating hearts -->
    <g transform="translate(20, 35)">
        <path d="M 0 3 C -2 1 -4 1 -4 -1 C -4 -3 -2 -4 0 -4 C 1 -4 2 -3 2 -1 C 2 -3 3 -4 4 -4 C 6 -4 8 -3 8 -1 C 8 1 5 3 2 6 C 0 3 -4 1 -4 -1 Z" 
              fill="#ec4899" opacity="0.8"/>
    </g>
    
    <g transform="translate(95, 25)">
        <path d="M 0 3 C -2 1 -4 1 -4 -1 C -4 -3 -2 -4 0 -4 C 1 -4 2 -3 2 -1 C 2 -3 3 -4 4 -4 C 6 -4 8 -3 8 -1 C 8 1 5 3 2 6 C 0 3 -4 1 -4 -1 Z" 
              fill="#ec4899" opacity="0.7"/>
    </g>
</svg>
