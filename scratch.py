import re

def process_index():
    with open('resources/js/Pages/Content/CertificationLogo/index.vue', 'r') as f:
        content = f.read()

    # Remove status column header
    content = re.sub(r'<th[^>]*>Status</th>\n\s*', '', content)
    # Remove status column cell
    content = re.sub(r'<td class="px-6 py-4">\s*<span[^>]*>\s*\{\{\s*item\.status\s*\}\}\s*</span>\s*</td>\n\s*', '', content)
    # Remove Bulk Publish button
    content = re.sub(r'<AppButton variant="success"[^>]*handleBulkPublish.*?/AppButton>\s*', '', content, flags=re.DOTALL)
    # Remove handleBulkPublish JS function
    content = re.sub(r'const handleBulkPublish = async \(\) => \{.+?\};\n', '', content, flags=re.DOTALL)
    # Remove isPublishing refs
    content = re.sub(r'const isPublishing = ref\(false\);\n', '', content)
    
    # Text replacements
    replacements = {
        'Lowongan Kerja': 'Logo Sertifikasi',
        'lowongan kerja': 'logo sertifikasi',
        'Lowongan': 'Logo',
        'lowongan': 'logo',
        'job-vacancies': 'certification-logos',
        'job_vacancies': 'certification_logos',
        'vacancies': 'logos',
        'Vacancies': 'Logos',
        'vacancy': 'logo',
        'Vacancy': 'Logo'
    }
    for k, v in replacements.items():
        content = content.replace(k, v)

    with open('resources/js/Pages/Content/CertificationLogo/index.vue', 'w') as f:
        f.write(content)

def process_form():
    with open('resources/js/Pages/Content/CertificationLogo/CertificationLogoForm.vue', 'r') as f:
        content = f.read()

    # Form text updates
    replacements = {
        'Lowongan Kerja': 'Logo Sertifikasi',
        'lowongan kerja': 'logo sertifikasi',
        'Lowongan': 'Logo',
        'lowongan': 'logo',
        'job-vacancies': 'certification-logos',
        'job_vacancies': 'certification_logos',
        'vacancies': 'logos',
        'Vacancies': 'Logos',
        'vacancy': 'logo',
        'Vacancy': 'Logo',
        'content:': 'description:',
        'form.content': 'form.description',
        'Konten Lowongan': 'Deskripsi Logo'
    }
    
    # Remove status from JS
    content = re.sub(r'status:\s*\'draft\',?', '', content)
    
    # We must also remove the status select option in the template
    content = re.sub(r'<div class="mb-4">\s*<label[^>]*>Status</label>.*?</div>\s*</div>\s*(<!-- Submit Button -->)', r'\1', content, flags=re.DOTALL)
    
    for k, v in replacements.items():
        content = content.replace(k, v)

    with open('resources/js/Pages/Content/CertificationLogo/CertificationLogoForm.vue', 'w') as f:
        f.write(content)

process_index()
process_form()
