export const site = {
  name: "Dreamstill",
  legalName: "DreamStill Technologies",
  tagline: "Clean technology for textile circularity",
  email: "info@dreamstill.ca",
  phone: "778-888-8541",
  phoneHref: "tel:+17788888541",
  address: "228 West 5th Avenue, Vancouver, BC",
  calendlyDiscovery: "https://calendly.com/dreamstill/discovery-call?hide_event_type_details=1&hide_gdpr_banner=1",
  calendlyPilot: "https://calendly.com/dreamstill/discovery-call?hide_event_type_details=1&hide_gdpr_banner=1",
  investorDeck: "mailto:info@dreamstill.ca?subject=Investor%20one-pager%20request",
  responseTime: "We respond within 2 business days.",
  whatsappGroup:
    "https://chat.whatsapp.com/KcDCExBU7fj6HTG8Xhsups",
  social: {
    instagram: "https://www.instagram.com/dreamstilll",
    linkedin: "https://ca.linkedin.com/company/dreamstilll",
    facebook: "https://www.facebook.com/people/DreamStill/61558387175265/",
  },
  mission:
    "To equip people and industries with tools and skills to see the true value of clothing and drive a collective movement toward a zero-waste future of textiles.",
} as const;

export const socialProof = [
  { value: "40+", label: "circular fashion activations hosted across BC" },
  { value: "1,000+", label: "community participants engaged in swaps, workshops, and panels" },
  { value: "1K+", label: "lbs of textiles diverted through Dreamstill programming—and counting" },
  { value: "2", label: "cities actively building Sorty pilot conversations" },
] as const;

export const canadaStats = [
  { value: "1.3M", label: "tonnes of textiles consumed in Canada each year" },
  { value: "1.1M", label: "tonnes of textiles disposed in Canada each year" },
  { value: "18%", label: "of disposed textiles in Canada are reused or recycled" },
  { value: "40+", label: "activations hosted by Dreamstill to date" },
] as const;

export const canadaStatsSource =
  "Canadian figures draw on Environment and Climate Change Canada waste characterization work (2018, the most recent national textile-specific characterization published) and Textile Exchange Preferred Fiber and Materials Market Report 2023 for consumption context. We update this section as newer national datasets are released.";

export const partnerTypes = [
  "Municipalities and regional waste programs",
  "Corporations and retreat planners",
  "Investors, grants, and climate funds",
  "Researchers and academic circular textile labs",
  "Thrift, consignment, and repair networks",
  "Community hosts and cultural institutions",
] as const;

export type Partner = {
  name: string;
  href?: string;
};

export const partners: Partner[] = [
  { name: "Slow Fashion Season", href: "https://www.instagram.com/slowfashionseason/" },
  { name: "Love Your Clothes", href: "https://loveyourclothes.org.uk/" },
  { name: "Fashion Revolution Week", href: "https://www.fashionrevolution.org/" },
  { name: "Ecorise", href: "https://ecorise.org/" },
  { name: "South Granville", href: "https://www.instagram.com/southgranville/" },
  { name: "UBC Slow Fibre Research Cluster" },
  { name: "Kelowna Fashion Weekend" },
];

export const recognition = [
  "Featured in circular fashion community programming across Metro Vancouver",
  "Buildspace venture development cohort (Fall 2024)",
  "Capstone product development partnership with UBC (Spring 2025)",
  "Fashion Revolution and climate activation collaborations",
] as const;

export const backedBy = ["Buildspace", "UBC capstone partners", "Community circular fashion hosts"] as const;

export const heroSlides = [
  {
    image: "/images/events/sorty-app.jpg",
    fallback: "/images/events/sorty-app.svg",
    title: "Scan your clothes in seconds",
    copy: "Sorty identifies garments, asks a few condition questions, and recommends the highest-value circular pathway.",
  },
  {
    image: "/images/events/community-swap.jpg",
    fallback: "/images/events/community-swap.svg",
    title: "Bring circular fashion to life in community",
    copy: "Swaps, repair workshops, styling nights, and climate activations that make reuse feel joyful and local.",
  },
  {
    image: "/images/events/local-map.jpg",
    fallback: "/images/events/local-map.svg",
    title: "Find local circular options near you",
    copy: "A pathway map helps residents discover repair, resale, donation, consignment, and recycling partners nearby.",
  },
] as const;

export const galleryImages = [
  {
    src: "/images/events/fashion-runway.jpg",
    fallback: "/images/events/fashion-runway.svg",
    title: "Fashion Revolution activation",
    meta: "Conference & cultural venue",
    className: "md:row-span-2 min-h-[420px]",
  },
  {
    src: "/images/events/eco-print.jpg",
    fallback: "/images/events/eco-print.svg",
    title: "Eco-print and textile storytelling",
    meta: "Team creative lab",
    className: "min-h-[260px]",
  },
  {
    src: "/images/events/pop-up-market.jpg",
    fallback: "/images/events/pop-up-market.svg",
    title: "Pop-up circular fashion market",
    meta: "Community activation",
    className: "min-h-[300px]",
  },
  {
    src: "/images/events/panel.jpg",
    fallback: "/images/events/panel.svg",
    title: "Climate and fashion panel",
    meta: "Public programming",
    className: "min-h-[300px]",
  },
  {
    src: "/images/events/clothing-swap.jpg",
    fallback: "/images/events/clothing-swap.svg",
    title: "Community clothing swap",
    meta: "Large-format event",
    className: "md:col-span-2 min-h-[340px]",
  },
] as const;
