<?php
/**
 * Reference content data for AppletLogic Child Theme
 */

global $SERVICES, $INDUSTRIES, $PROJECTS, $TESTIMONIALS, $TECHS1, $TECHS2;

$SERVICES = [
  [
    "slug" => "web-development",
    "name" => "Web Development",
    "icon" => "⌘",
    "cls" => "ic-blue",
    "short" => "Enterprise websites, corporate platforms, landing pages, CMS builds, and fully custom web platforms engineered for speed and scale.",
    "tags" => ["Next.js", "React", "Angular", "WordPress", "Custom Platforms"],
    "problem" => "Slow, dated websites bleed credibility and conversions. Enterprises struggle with CMS chaos, poor Core Web Vitals, and platforms that can't keep pace with the business.",
    "solution" => "We engineer modern web platforms on Next.js, React, and Angular — SEO-first, blazing fast, and built on maintainable architecture your team can grow with for years.",
    "benefits" => [
      ["⚡", "Sub-second loads", "Core Web Vitals in the green — better rankings and conversions."],
      ["◈", "SEO-first builds", "Schema markup, semantic structure, and technical SEO baked in."],
      ["▣", "CMS your team loves", "Headless or WordPress — editors publish without developers."],
      ["⬢", "Scales with you", "Component architecture ready for new products and markets."],
      ["✓", "Enterprise security", "Hardened deployments, audits, and access control."],
      ["∞", "Future-proof stack", "Modern frameworks with long-term community support."]
    ],
    "process" => [
      "Discovery & sitemap architecture",
      "UX wireframes & design system",
      "Component development in sprints",
      "Content & CMS integration",
      "QA, performance & SEO audit",
      "Launch, monitoring & iteration"
    ],
    "techs" => ["Next.js", "React", "Angular", "TypeScript", "WordPress", "Tailwind", "Node.js", "Vercel"],
    "cs" => [
      "stat" => "+312%",
      "statLabel" => "organic traffic in 6 months",
      "title" => "Corporate platform rebuild for a manufacturing exporter",
      "text" => "A 40-page legacy site rebuilt on Next.js with headless CMS — organic traffic tripled and enquiry conversions doubled within two quarters."
    ],
    "faqs" => [
      ["How long does an enterprise website take?", "Typically 6–10 weeks depending on page count and integrations. A working staging build ships in the first sprint."],
      ["Can you migrate our existing content?", "Yes — automated migration scripts plus manual QA on every page, with 301 redirects to protect SEO."],
      ["Do you provide maintenance after launch?", "Every build includes a support window, and most clients continue on a monthly care plan with updates, backups, and improvements."]
    ]
  ],
  [
    "slug" => "mobile-apps",
    "name" => "Mobile App Development",
    "icon" => "▯",
    "cls" => "ic-cyan",
    "short" => "Native Android & iOS apps, cross-platform builds, and secure enterprise mobile solutions your teams and customers love.",
    "tags" => ["Flutter", "React Native", "Android", "iOS", "Enterprise Apps"],
    "problem" => "Businesses lose customers to clunky mobile experiences — and internal teams to paper processes that a well-built app would eliminate.",
    "solution" => "We design and ship polished native and cross-platform apps, from consumer products to secure enterprise field tools, with analytics and crash-free reliability from day one.",
    "benefits" => [
      ["◈", "One codebase, two stores", "Flutter / React Native cuts cost and time-to-market ~40%."],
      ["⚡", "Native performance", "60fps interactions and offline-first data sync."],
      ["▣", "Store-ready launch", "We handle Play Store & App Store submission end-to-end."],
      ["✓", "Enterprise-grade security", "SSO, encryption at rest, and MDM compatibility."],
      ["∞", "Analytics built in", "Know exactly how users behave from the first install."],
      ["⬢", "Scalable backends", "APIs and infrastructure that grow with your user base."]
    ],
    "process" => [
      "Product discovery & user journeys",
      "UX/UI prototyping & validation",
      "API & backend architecture",
      "Sprint-based app development",
      "Device-matrix QA & beta testing",
      "Store launch & growth support"
    ],
    "techs" => ["Flutter", "React Native", "Kotlin", "Swift", "Firebase", "FastAPI", "PostgreSQL"],
    "cs" => [
      "stat" => "3.1×",
      "statLabel" => "repeat purchases in 2 quarters",
      "title" => "Omnichannel commerce app for a 60-outlet retail chain",
      "text" => "A unified store + online experience with loyalty, push journeys, and in-store pickup — repeat purchase rate tripled."
    ],
    "faqs" => [
      ["Native or cross-platform — which should we choose?", "For most products, Flutter or React Native delivers native-feel quality at lower cost. We recommend native only when deep hardware access demands it."],
      ["Do you build the backend too?", "Yes — APIs, databases, admin panels, and cloud infrastructure are part of the engagement."],
      ["Will you publish the app for us?", "We manage the full Play Store and App Store submission, including assets, listings, and review responses."]
    ]
  ],
  [
    "slug" => "custom-software",
    "name" => "Custom Software Development",
    "icon" => "⬡",
    "cls" => "ic-vio",
    "short" => "ERP, CRM, HRMS, inventory, internal systems, and multi-tenant SaaS platforms — built around how your business actually operates.",
    "tags" => ["ERP", "CRM", "HRMS", "SaaS", "Internal Systems"],
    "problem" => "Off-the-shelf tools force your business into their shape — teams juggle spreadsheets, duplicate data entry, and workarounds that cost hours daily.",
    "solution" => "We build software around your workflows: ERPs, CRMs, HRMS, and SaaS products with clean architecture, role-based access, and reporting your leadership actually uses.",
    "benefits" => [
      ["▣", "Fits your workflow", "No more bending processes to fit rigid software."],
      ["⚡", "Kills duplicate work", "One source of truth across departments."],
      ["◈", "Owns your data", "Your systems, your database, your rules — no vendor lock-in."],
      ["✓", "Role-based control", "Fine-grained permissions and complete audit trails."],
      ["∞", "SaaS-ready", "Multi-tenant architecture if you want to productise it."],
      ["⬢", "Integrates everything", "Connects to Tally, payment gateways, WhatsApp, and more."]
    ],
    "process" => [
      "Workflow mapping & requirement spec",
      "System architecture & data modelling",
      "Module-by-module sprint delivery",
      "Integration with existing tools",
      "UAT with your actual teams",
      "Rollout, training & support"
    ],
    "techs" => ["Node.js", "NestJS", "Python", "FastAPI", "React", "PostgreSQL", "MongoDB", "Redis"],
    "cs" => [
      "stat" => "−68%",
      "statLabel" => "admin hours per month",
      "title" => "Unified ERP for a construction group",
      "text" => "Procurement, inventory, payroll, and project billing in one system — replacing 14 spreadsheets and cutting admin effort by two-thirds."
    ],
    "faqs" => [
      ["How do you handle changing requirements?", "Sprint-based delivery means scope evolves safely — you reprioritise each cycle without derailing the budget."],
      ["Who owns the source code?", "You do. Full code, documentation, and infrastructure handover are contractual."],
      ["Can you integrate with our existing tools?", "Yes — accounting software, payment gateways, biometric devices, WhatsApp, and most APIs."]
    ]
  ],
  [
    "slug" => "ai-automation",
    "name" => "AI Automation",
    "icon" => "◎",
    "cls" => "ic-red",
    "short" => "GPT integrations, chatbots, AI agents, document intelligence, and workflow automation that turn manual hours into machine minutes.",
    "tags" => ["AI Agents", "Chatbots", "Document AI", "Workflows", "BI"],
    "problem" => "Teams drown in repetitive knowledge work — reading documents, answering the same questions, moving data between systems — while AI capability sits unused.",
    "solution" => "We deploy production-grade AI: custom GPT integrations, retrieval-augmented chatbots, autonomous agents, and document pipelines that work reliably inside your business.",
    "benefits" => [
      ["◎", "24/7 AI assistants", "Chatbots that resolve real queries, not just deflect them."],
      ["⚡", "Documents that read themselves", "Invoices, contracts, and forms extracted automatically."],
      ["▣", "Agents that act", "AI that updates CRMs, drafts replies, and triggers workflows."],
      ["✓", "Grounded in your data", "RAG pipelines keep answers accurate and on-brand."],
      ["∞", "Human-in-the-loop", "Approval gates where judgment matters."],
      ["⬢", "Measurable ROI", "Hours saved and accuracy tracked from week one."]
    ],
    "process" => [
      "Automation opportunity audit",
      "Data preparation & guardrails",
      "Prototype with your real cases",
      "Integration into daily tools",
      "Accuracy tuning & evaluation",
      "Scale-out & monitoring"
    ],
    "techs" => ["OpenAI", "LangChain", "Python", "FastAPI", "TensorFlow", "Vector DBs", "n8n"],
    "cs" => [
      "stat" => "4,200",
      "statLabel" => "hours automated per year",
      "title" => "Quote-to-invoice AI for a manufacturing exporter",
      "text" => "Document AI reads enquiries, drafts quotes, and syncs the CRM — cutting cycle time 70% and freeing two full-time roles for higher-value work."
    ],
    "faqs" => [
      ["Is our data safe with AI systems?", "Yes — we design for privacy: private deployments where needed, no training on your data, and strict access controls."],
      ["What if the AI makes mistakes?", "Every workflow includes confidence thresholds and human review gates. Accuracy is measured and tuned continuously."],
      ["Which AI models do you use?", "The best fit for the task — OpenAI, open-source models, or hybrids — balanced for cost, speed, and accuracy."]
    ]
  ],
  [
    "slug" => "business-automation",
    "name" => "Business Automation",
    "icon" => "↻",
    "cls" => "ic-blue",
    "short" => "Lead capture to close — CRM integration, sales automation, WhatsApp & email journeys, and approval workflows on autopilot.",
    "tags" => ["Lead Automation", "WhatsApp", "Email Journeys", "CRM", "Approvals"],
    "problem" => "Leads leak between ads, calls, and spreadsheets. Follow-ups depend on memory, approvals crawl through email chains, and nobody trusts the pipeline numbers.",
    "solution" => "We wire your revenue engine end-to-end: instant lead routing, WhatsApp and email nurture journeys, CRM hygiene automation, and approval workflows with full visibility.",
    "benefits" => [
      ["⚡", "5-minute lead response", "Every enquiry gets an instant, personalised reply."],
      ["▣", "Zero leads lost", "Ads, calls, forms, and WhatsApp all flow into one pipeline."],
      ["◈", "Nurture on autopilot", "Multi-step WhatsApp + email journeys that convert."],
      ["✓", "Approvals in hours", "Structured workflows replace endless email threads."],
      ["∞", "Clean CRM, always", "Deduplication and enrichment run automatically."],
      ["⬢", "Pipeline you can trust", "Real-time dashboards for every stage and owner."]
    ],
    "process" => [
      "Revenue process mapping",
      "Tool audit & integration plan",
      "Journey design & copywriting",
      "Automation build & CRM wiring",
      "Team training & handover",
      "Optimisation on live data"
    ],
    "techs" => ["WhatsApp API", "Zoho", "HubSpot", "n8n", "Zapier", "Google Workspace", "Meta Ads"],
    "cs" => [
      "stat" => "+41%",
      "statLabel" => "lead-to-meeting conversion",
      "title" => "Sales automation for a real-estate developer",
      "text" => "Instant WhatsApp responses, site-visit scheduling, and automated follow-up sequences lifted conversions 41% in 90 days."
    ],
    "faqs" => [
      ["We already use a CRM — will this work with it?", "Yes. We build on top of your existing stack (Zoho, HubSpot, Salesforce, or custom) rather than replacing it."],
      ["Is WhatsApp automation compliant?", "We use the official WhatsApp Business API with approved templates — fully compliant and ban-safe."],
      ["How fast do we see results?", "Most clients see measurable response-time and conversion improvements within the first month."]
    ]
  ],
  [
    "slug" => "cloud-solutions",
    "name" => "Cloud Solutions",
    "icon" => "☁",
    "cls" => "ic-cyan",
    "short" => "Cloud architecture, server migration, DevOps pipelines, containerisation, and CI/CD that keep releases fast and infrastructure lean.",
    "tags" => ["AWS", "Azure", "Google Cloud", "Docker", "CI/CD", "DevOps"],
    "problem" => "Servers fall over on traffic spikes, deployments are weekend-long panic events, and cloud bills grow without anyone knowing why.",
    "solution" => "We architect lean, secure cloud infrastructure on AWS, Azure, or GCP — with Docker, Kubernetes, and CI/CD pipelines that make deployments boring and bills predictable.",
    "benefits" => [
      ["☁", "Zero-downtime releases", "Ship daily with automated pipelines and rollbacks."],
      ["⚡", "Scales on demand", "Auto-scaling handles spikes without over-provisioning."],
      ["▣", "Bills you understand", "Cost optimisation typically cuts cloud spend 25–40%."],
      ["✓", "Security by design", "IAM, encryption, backups, and compliance baselines."],
      ["∞", "Observability", "Monitoring and alerts before users notice anything."],
      ["⬢", "Disaster-ready", "Tested backup and recovery plans, not just hopes."]
    ],
    "process" => [
      "Infrastructure & cost audit",
      "Target architecture design",
      "Containerisation & IaC setup",
      "Migration with rollback plans",
      "CI/CD pipeline automation",
      "Monitoring, SLA & optimisation"
    ],
    "techs" => ["AWS", "Azure", "Google Cloud", "Docker", "Kubernetes", "Terraform", "GitHub Actions", "Redis"],
    "cs" => [
      "stat" => "99.99%",
      "statLabel" => "uptime after migration",
      "title" => "Cloud migration for a fintech platform",
      "text" => "Monolith to containers on AWS with full CI/CD — deployments went from monthly panic to daily non-events, at 32% lower cost."
    ],
    "faqs" => [
      ["Will migration cause downtime?", "We plan phased migrations with parallel running and rollback points — most cutovers happen with zero user-facing downtime."],
      ["Can you reduce our current cloud bill?", "Usually yes — right-sizing, reserved capacity, and architecture fixes typically save 25–40%."],
      ["Do you provide ongoing DevOps support?", "Yes — managed DevOps retainers with SLAs cover monitoring, incidents, and continuous improvement."]
    ]
  ],
  [
    "slug" => "data-management",
    "name" => "Data Management",
    "icon" => "▤",
    "cls" => "ic-vio",
    "short" => "Database design, data migration, ETL pipelines, and Power BI dashboards that turn scattered data into decisions.",
    "tags" => ["Power BI", "ETL", "Analytics", "Dashboards", "Migration"],
    "problem" => "Data lives in silos — ERP here, Excel there, ads platform somewhere else. Leadership decisions run on gut feel and month-old reports.",
    "solution" => "We unify your data: robust database design, automated ETL pipelines, and live Power BI dashboards that put trustworthy numbers in front of every decision-maker.",
    "benefits" => [
      ["▤", "Single source of truth", "All systems feed one governed data model."],
      ["⚡", "Live dashboards", "KPIs update automatically — no more monthly report scramble."],
      ["◈", "Self-serve analytics", "Teams answer their own questions in Power BI."],
      ["✓", "Data you can trust", "Validation and lineage on every pipeline."],
      ["∞", "History preserved", "Clean migrations with zero data loss."],
      ["⬢", "Ready for AI", "Structured data is the foundation for every AI initiative."]
    ],
    "process" => [
      "Data source & quality audit",
      "Warehouse / model design",
      "ETL pipeline development",
      "Dashboard & report build",
      "Validation with stakeholders",
      "Training & governance setup"
    ],
    "techs" => ["Power BI", "Python", "PostgreSQL", "MySQL", "MongoDB", "Azure Data Factory", "Airflow"],
    "cs" => [
      "stat" => "6 hrs",
      "statLabel" => "loan approvals, down from 5 days",
      "title" => "Lending intelligence platform for an NBFC",
      "text" => "ETL + Power BI decisioning stack unified 7 data sources — approval turnaround collapsed from 5 days to 6 hours."
    ],
    "faqs" => [
      ["Our data is messy — can you still help?", "That's the normal starting point. Cleaning and structuring messy data is the first phase of every engagement."],
      ["Do we need a data warehouse?", "Not always — we size the architecture to your volume. Sometimes a well-modelled database is enough."],
      ["Can our team maintain the dashboards?", "Yes — we train your team and document everything so you're self-sufficient."]
    ]
  ],
  [
    "slug" => "digital-marketing",
    "name" => "Digital Marketing",
    "icon" => "➤",
    "cls" => "ic-red",
    "short" => "SEO, performance marketing, Google Ads, branding, social, and content programs measured on pipeline — not vanity metrics.",
    "tags" => ["SEO", "Google Ads", "Performance", "Branding", "Content"],
    "problem" => "Ad spend climbs while lead quality drops. SEO reports are full of jargon but empty of revenue. Nobody can say which channel actually pays.",
    "solution" => "We run marketing like engineers: full-funnel tracking, SEO built on technical foundations, performance campaigns optimised to cost-per-qualified-lead, and content that ranks.",
    "benefits" => [
      ["➤", "Revenue attribution", "Know exactly which rupee of spend created which deal."],
      ["⚡", "Qualified leads, not clicks", "Campaigns optimised to pipeline, not impressions."],
      ["◈", "Compounding SEO", "Technical + content SEO that keeps paying after the spend."],
      ["✓", "Brand consistency", "Design and messaging systems across every channel."],
      ["∞", "Always-on testing", "Landing pages and creatives improved weekly."],
      ["⬢", "Transparent reporting", "One live dashboard — no 40-page PDF decks."]
    ],
    "process" => [
      "Funnel & analytics audit",
      "Strategy & channel planning",
      "Tracking & landing page setup",
      "Campaign & content launch",
      "Weekly optimisation sprints",
      "Monthly growth reviews"
    ],
    "techs" => ["Google Ads", "Meta Ads", "GA4", "Search Console", "SEMrush", "Power BI", "WordPress"],
    "cs" => [
      "stat" => "−47%",
      "statLabel" => "cost per qualified lead",
      "title" => "Performance overhaul for a healthcare group",
      "text" => "Rebuilt tracking, landing pages, and campaign structure — cost per qualified lead nearly halved while volume grew 2.2×."
    ],
    "faqs" => [
      ["How soon does SEO show results?", "Technical fixes show movement in weeks; meaningful ranking growth typically compounds over 3–6 months."],
      ["What's the minimum ad budget to start?", "We work with budgets from modest to enterprise scale — strategy is sized to spend so nothing is wasted."],
      ["Do you handle creatives and content?", "Yes — ad creatives, landing pages, and SEO content are produced in-house."]
    ]
  ],
  [
    "slug" => "ui-ux-design",
    "name" => "UI / UX Design",
    "icon" => "◐",
    "cls" => "ic-cyan",
    "short" => "Research, wireframes, prototypes, design systems, and user testing — interfaces that feel obvious the first time you use them.",
    "tags" => ["Figma", "Design Systems", "Prototypes", "User Testing", "Research"],
    "problem" => "Products lose users at first touch — confusing flows, inconsistent screens, and features nobody can find. Redesigns happen on opinion, not evidence.",
    "solution" => "We design with evidence: user research, rapid prototyping, usability testing, and scalable design systems in Figma that keep every future screen consistent.",
    "benefits" => [
      ["◐", "Evidence over opinion", "Research and testing drive every design decision."],
      ["⚡", "Faster development", "Design systems cut front-end build time dramatically."],
      ["▣", "Consistent everywhere", "One visual language across web, mobile, and internal tools."],
      ["✓", "Accessible by default", "WCAG-aware color, contrast, and interaction patterns."],
      ["∞", "Prototype before build", "Validate flows with real users before writing code."],
      ["⬢", "Conversion-focused", "UX tuned to the metric that matters for each screen."]
    ],
    "process" => [
      "Stakeholder & user research",
      "Information architecture",
      "Wireframes & user flows",
      "High-fidelity UI & prototypes",
      "Usability testing rounds",
      "Design system & handover"
    ],
    "techs" => ["Figma", "FigJam", "Maze", "Lottie", "Framer", "Zeplin"],
    "cs" => [
      "stat" => "+58%",
      "statLabel" => "onboarding completion",
      "title" => "UX overhaul for a SaaS onboarding flow",
      "text" => "Research revealed three drop-off points; a redesigned five-step flow lifted completion 58% and support tickets fell by a third."
    ],
    "faqs" => [
      ["Do you redesign existing products?", "Yes — UX audits of live products are one of our most common starting points."],
      ["Will developers get proper handoff?", "Complete Figma specs, tokens, and a documented design system — built for clean developer handover."],
      ["Can you work with our brand guidelines?", "Absolutely. We extend existing brands into full digital design systems."]
    ]
  ],
  [
    "slug" => "corporate-training",
    "name" => "Corporate Training",
    "icon" => "✎",
    "cls" => "ic-blue",
    "short" => "Hands-on upskilling for teams — AI, Power BI, data analytics, web development, cloud, DevOps, and Python, delivered by practitioners.",
    "tags" => ["AI", "Power BI", "Python", "Cloud", "DevOps", "Upskilling"],
    "problem" => "Teams know the tools are changing — AI, cloud, analytics — but generic courses don't stick, and skills gaps slow down every initiative.",
    "solution" => "Practitioner-led, hands-on training built around your real data and real projects: AI, Power BI, Python, web, cloud, and DevOps programs your team applies the next day.",
    "benefits" => [
      ["✎", "Taught by builders", "Trainers who ship production systems, not just slides."],
      ["⚡", "Your data, your cases", "Exercises built on scenarios from your own business."],
      ["▣", "Immediately applicable", "Teams leave with working artifacts, not certificates alone."],
      ["✓", "All levels", "Tracks for beginners through advanced engineers."],
      ["∞", "Post-training support", "Office hours and a doubt channel after every program."],
      ["⬢", "Measurable outcomes", "Pre/post assessments show exactly what improved."]
    ],
    "process" => [
      "Skills gap assessment",
      "Curriculum customisation",
      "Hands-on workshop delivery",
      "Project-based practice",
      "Assessment & certification",
      "Follow-up support window"
    ],
    "techs" => ["Python", "Power BI", "OpenAI", "AWS", "Docker", "React", "SQL", "Excel"],
    "cs" => [
      "stat" => "40",
      "statLabel" => "engineers upskilled in one cohort",
      "title" => "AI & DevOps program for an enterprise IT team",
      "text" => "A six-week practical program — by the end, teams had automated three internal workflows and containerised two legacy apps."
    ],
    "faqs" => [
      ["Can training be delivered on-site?", "Yes — on-site across India, or live online with the same hands-on format."],
      ["How large can a batch be?", "We recommend 15–25 for hands-on quality; larger cohorts run in parallel tracks."],
      ["Do participants get certificates?", "Yes — assessment-backed certificates, plus a skills report for L&D teams."]
    ]
  ]
];

$INDUSTRIES = [
  ["✚", "Healthcare", "HMS, OPD automation, patient portals, telemedicine"],
  ["✎", "Education", "LMS platforms, admission automation, analytics"],
  ["⬢", "Retail", "E-commerce, POS integration, loyalty apps"],
  ["⚙", "Manufacturing", "ERP, quote automation, production dashboards"],
  ["⌂", "Real Estate", "Lead automation, site-visit booking, CRM"],
  ["₹", "Finance", "Lending platforms, risk dashboards, compliance"],
  ["➜", "Logistics", "Fleet tracking, route dashboards, order systems"],
  ["✦", "Hospitality", "Booking engines, guest apps, review automation"],
  ["▲", "Construction", "Project billing, procurement, site reporting"],
  ["↗", "Startups", "MVPs, product engineering, growth stacks"],
  ["◉", "Government", "Citizen portals, workflow digitisation, dashboards"]
];

$PROJECTS = [
  ["ind" => "Healthcare", "tech" => "Next.js · AI", "title" => "Hospital OPD Automation Suite", "text" => "AI-assisted triage, appointment automation, and live bed-availability dashboards — cutting patient wait time by 41%.", "art" => 0],
  ["ind" => "Retail", "tech" => "Flutter · Cloud", "title" => "Omnichannel Commerce App", "text" => "A unified store + online experience for a 60-outlet retail chain — 3.1× repeat purchases within two quarters.", "art" => 1],
  ["ind" => "Finance", "tech" => "Power BI · Python", "title" => "Lending Intelligence Platform", "text" => "ETL + Power BI decisioning stack for an NBFC — loan approval turnaround down from 5 days to 6 hours.", "art" => 2],
  ["ind" => "Real Estate", "tech" => "WhatsApp · CRM", "title" => "Sales Automation Engine", "text" => "Instant WhatsApp response and follow-up journeys — lead-to-meeting conversion up 41% in 90 days.", "art" => 1],
  ["ind" => "Manufacturing", "tech" => "AI · FastAPI", "title" => "Quote-to-Invoice Document AI", "text" => "AI reads enquiries, drafts quotes, and syncs the CRM — 4,200 hours automated per year.", "art" => 0],
  ["ind" => "Fintech", "tech" => "AWS · Kubernetes", "title" => "Zero-Downtime Cloud Migration", "text" => "Monolith to containers with full CI/CD — 99.99% uptime at 32% lower infrastructure cost.", "art" => 2]
];

$TESTIMONIALS = [
  ["RS", "Dr. Rakesh S.", "Director, Multispecialty Hospital Group", "AppletLogic rebuilt our patient portal and automated our OPD workflows. What impressed us most was speed — a working release in three weeks, not three months.", "linear-gradient(140deg,#356DFF,#27D7FF)"],
  ["AM", "Anita M.", "COO, Manufacturing Exporter", "Their AI automation cut our quote-to-invoice cycle by 70%. The team communicates like an in-house squad — same-day answers, always.", "linear-gradient(140deg,#E8434E,#9E1B22)"],
  ["JT", "Joseph T.", "CTO, Fintech Startup", "From cloud migration to CI/CD, everything just works now. Deployments went from monthly panic to daily non-events.", "linear-gradient(140deg,#4A3DD8,#356DFF)"],
  ["PK", "Priya K.", "VP Operations, Logistics Firm", "The Power BI dashboards they built are now the first tab our leadership opens every morning. Data finally drives our decisions.", "linear-gradient(140deg,#27D7FF,#356DFF)"],
  ["VN", "Vikram N.", "L&D Head, Enterprise IT", "They trained 40 of our engineers on AI and DevOps — practical, hands-on, and immediately applicable. Best corporate training we've run.", "linear-gradient(140deg,#9E1B22,#E8434E)"]
];

$TECHS1 = ["React", "Angular", "Next.js", "Node.js", "NestJS", "Python", "FastAPI", "Flutter", "AWS", "Azure", "Google Cloud"];
$TECHS2 = ["Docker", "Kubernetes", "MongoDB", "PostgreSQL", "MySQL", "Redis", "Power BI", "TensorFlow", "OpenAI", "LangChain"];
