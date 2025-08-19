@extends('admin.layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

<style>
    
body {
  background-color: #f8f9fa;
}
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: auto;
      scrollbar-width: none; 
      -ms-overflow-style: none; 
    }

    body::-webkit-scrollbar {
      display: none;
    }

  .help-wrapper {
    max-width: 900px;
    width: 100%;
    margin: 0 auto;
    padding: 30px 20px;      
  }

  .glass-card {
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid #e2e8f0;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 16px;
    box-shadow: 0 12px 24px rgba(0,0,0,0.05);
    padding: 40px;
  }

  .help-title {
    font-size: 32px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 10px;
  }

  .help-subtitle {
    font-size: 16px;
    color: #6b7280;
    margin-bottom: 30px;
  }

  .accordion {
    margin-top: 1.5rem;
  }

  .accordion-button {
    font-weight: 600;
    color: #4b5563;
    background-color: #f8fafc;
    font-size: 1rem;
    padding: 1rem 1.25rem;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .accordion-button:not(.collapsed) {
    background-color: #e5e7eb;
    color: #374151;
  }

  .accordion-button:hover {
    background-color: #e0e7ff;
    color: #1f2937;
  }

  .help-contact {
    margin-top: 3rem;
    padding: 2rem;
    background-color: #f9fafb;
    border-radius: 12px;
    text-align: center;
    border: 1px solid #e5e7eb;
  }

  .help-contact h5 {
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1.25rem;
  }

  .help-contact p {
    color: #4b5563;
    font-size: 1rem;
    margin: 0.25rem 0;
  }

  .help-contact a {
    color: #6366f1;
    text-decoration: none;
    font-weight: 600;
  }

  .help-contact a:hover {
    color: #4338ca;
    text-decoration: underline;
  }

  .contact-icon {
    margin-right: 8px;
    color: #6366f1;
    font-size: 1rem;
  }
</style>

<div class="wrapper">
  <div class="help-wrapper">
    <div class="glass-card">
      <div class="help-title">Help & Support</div>
      <div class="help-subtitle">Need assistance? Browse the FAQs below or contact us directly.</div>

      <div class="accordion mb-5" id="faqAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="faq1">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse1"
              aria-expanded="false"
              aria-controls="collapse1"
            >
              How do I approve a developer profile?
            </button>
          </h2>
          <div
            id="collapse1"
            class="accordion-collapse collapse"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Go to the "Pending" section in the sidebar, review the developer details, and click "Approve".
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="faq2">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse2"
              aria-expanded="false"
              aria-controls="collapse2"
            >
              How do I reset my admin password?
            </button>
          </h2>
          <div
            id="collapse2"
            class="accordion-collapse collapse"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Navigate to your profile page and click on "Change Password". Follow the instructions to reset.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="faq3">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse3"
              aria-expanded="false"
              aria-controls="collapse3"
            >
              How can I view all posted jobs?
            </button>
          </h2>
          <div
            id="collapse3"
            class="accordion-collapse collapse"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Use the "Postings" link in the sidebar to see all jobs posted by employers.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="faq4">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse4"
              aria-expanded="false"
              aria-controls="collapse4"
            >
              How do I contact a developer or employer?
            </button>
          </h2>
          <div
            id="collapse4"
            class="accordion-collapse collapse"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Go to the "Messages" section to initiate direct communication.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="faq5">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse5"
              aria-expanded="false"
              aria-controls="collapse5"
            >
              Can I edit a developer’s profile after approval?
            </button>
          </h2>
          <div
            id="collapse5"
            class="accordion-collapse collapse"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Yes, approved developer profiles can be edited by navigating to their profile and clicking "Edit".
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="faq6">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse6"
              aria-expanded="false"
              aria-controls="collapse6"
            >
              What should I do if I find a bug?
            </button>
          </h2>
          <div
            id="collapse6"
            class="accordion-collapse collapse"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Please report bugs via the "Bug Report" issue type in the contact form or email support directly.
            </div>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header" id="faq7">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse7"
              aria-expanded="false"
              aria-controls="collapse7"
            >
              How can I request new features?
            </button>
          </h2>
          <div
            id="collapse7"
            class="accordion-collapse collapse"
            data-bs-parent="#faqAccordion"
          >
            <div class="accordion-body">
              Feature requests can be submitted through the contact form under "Feature Request" or by emailing our support team.
            </div>
          </div>
        </div>
      </div>

      <div class="help-contact">
        <h5>Still need help?</h5>
        <p>Contact our support team and we'll assist you promptly.</p>
        <p>
          <strong><i class="fas fa-envelope contact-icon"></i>Email:</strong>
          <a href="mailto:support@devconnect.com">support@devconnect.com</a>
        </p>
        <p>
          <strong><i class="fas fa-phone contact-icon"></i>Phone:</strong>
          <a href="tel:+1234567890">+1 234 567 890</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
