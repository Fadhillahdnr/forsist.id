<svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => 'w-10 h-10 text-current']) }}>
    <!-- Cart Handle Left (Dark Pink) -->
    <path d="M 40 55 Q 20 30 15 10" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    
    <!-- Cart Handle Right (Dark Pink) -->
    <path d="M 80 55 Q 100 30 105 10" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    
    <!-- Handle Grips Left -->
    <circle cx="15" cy="10" r="4" fill="currentColor"/>
    
    <!-- Handle Grips Right -->
    <circle cx="105" cy="10" r="4" fill="currentColor"/>
    
    <!-- Cart Body (Main Rectangle) -->
    <rect x="30" y="50" width="60" height="35" rx="3" fill="currentColor" opacity="0.8"/>
    
    <!-- Cart Body Outline -->
    <rect x="30" y="50" width="60" height="35" rx="3" fill="none" stroke="currentColor" stroke-width="2.5"/>
    
    <!-- Basket Grid Lines (Vertical) -->
    <line x1="38" y1="50" x2="38" y2="85" stroke="white" stroke-width="1.5" opacity="0.7"/>
    <line x1="46" y1="50" x2="46" y2="85" stroke="white" stroke-width="1.5" opacity="0.7"/>
    <line x1="54" y1="50" x2="54" y2="85" stroke="white" stroke-width="1.5" opacity="0.7"/>
    <line x1="62" y1="50" x2="62" y2="85" stroke="white" stroke-width="1.5" opacity="0.7"/>
    <line x1="70" y1="50" x2="70" y2="85" stroke="white" stroke-width="1.5" opacity="0.7"/>
    <line x1="78" y1="50" x2="78" y2="85" stroke="white" stroke-width="1.5" opacity="0.7"/>
    
    <!-- Basket Grid Lines (Horizontal) -->
    <line x1="30" y1="60" x2="90" y2="60" stroke="white" stroke-width="1.5" opacity="0.7"/>
    <line x1="30" y1="70" x2="90" y2="70" stroke="white" stroke-width="1.5" opacity="0.7"/>
    
    <!-- Left Wheel -->
    <circle cx="38" cy="92" r="5" fill="currentColor"/>
    <circle cx="38" cy="92" r="3" fill="none" stroke="white" stroke-width="1" opacity="0.8"/>
    
    <!-- Right Wheel -->
    <circle cx="82" cy="92" r="5" fill="currentColor"/>
    <circle cx="82" cy="92" r="3" fill="none" stroke="white" stroke-width="1" opacity="0.8"/>
    
    <!-- Heart Badge (Center) -->
    <g transform="translate(60, 67)">
        <path d="M 0 5 C -4 1 -8 1 -8 -2 C -8 -5 -5 -7 -2 -7 C 0 -7 2 -5 2 -2 C 2 -5 4 -7 6 -7 C 9 -7 12 -5 12 -2 C 12 1 8 5 2 10 C -2 5 -8 1 -8 -2 Z" fill="white" opacity="0.95"/>
    </g>
    
    <!-- Decorative floating hearts -->
    <path d="M 20 35 C 18 33 16 33 16 31 C 16 29 18 28 20 28 C 21 28 22 29 22 31 C 22 29 23 28 24 28 C 26 28 28 29 28 31 C 28 33 25 35 22 38 C 20 35 16 33 16 31 Z" fill="currentColor" opacity="0.6"/>
    
    <path d="M 95 25 C 93 23 91 23 91 21 C 91 19 93 18 95 18 C 96 18 97 19 97 21 C 97 19 98 18 99 18 C 101 18 103 19 103 21 C 103 23 100 25 97 28 C 95 25 91 23 91 21 Z" fill="currentColor" opacity="0.5"/>
</svg>
