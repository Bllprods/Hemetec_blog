// nextjs/hemetec/src/app/PaginaNoticia/[id]/page.tsx
import '../../fonte.css';
import { redirect } from "next/navigation";
import fs from 'fs/promises';
import path from 'path';
import BackButton from './BackButton'; // Client Component
 
type Post = {
  id_noticia: number;
  titulo?: string;
  subtitulo?: string;
  criado_em?: string;
  txt_url?: string;
  id_versao?: number;
  imagens?: string[];
  autor?: string;
};
 
// Next.js ISR: cache de 10 segundos
export const revalidate = 10;
 
export default async function PaginaNoticia(props: any) {
  const params = await Promise.resolve(props.params);
  const searchParams = await Promise.resolve(props.searchParams);
 
  const id = params?.id;
  const fromTela = searchParams?.fromTela;
 
  if (!id || fromTela !== "1") {
    redirect("/TelaNoticias");
  }
 
  // Caminho para o data.json na raiz da pasta 'a'
  const dataJsonPath = path.join(process.cwd(), '..', '..', 'data.json');
 
  let data: Post[] = [];
  try {
    const jsonData = await fs.readFile(dataJsonPath, 'utf-8');
    data = JSON.parse(jsonData);
  } catch (err) {
    console.error("Erro ao ler/parsear data.json:", err);
    return <div id="Corpo" className="body-next">Erro ao carregar a notícia.</div>;
  }
 
  const noticia = data.find((n: Post) => Number(n.id_noticia) === Number(id));
  if (!noticia) return <div id="Corpo" className="body-next">Notícia não encontrada</div>;
 
  const dataFormatada = noticia.criado_em
    ? (() => {
        const d = new Date(noticia.criado_em);
        return isNaN(d.getTime()) ? "Data inválida" : d.toLocaleDateString('pt-BR');
      })()
    : "Data não disponível";
 
  // Lê conteúdo do TXT
  let conteudoTxt = 'Conteúdo não disponível';
  if (noticia.txt_url) {
    try {
      const nomeArquivo = path.basename(String(noticia.txt_url));
      const txtPath = path.join(process.cwd(), '..', '..', 'app', 'docs', 'arquivos', nomeArquivo);
      const existe = await fs.access(txtPath).then(() => true).catch(() => false);
      if (existe) {
        conteudoTxt = await fs.readFile(txtPath, 'utf-8');
      } else {
        console.error("Arquivo TXT não encontrado:", txtPath);
        conteudoTxt = `Arquivo de texto não encontrado: ${nomeArquivo}`;
      }
    } catch (err) {
      console.error("Erro ao ler arquivo TXT:", err);
      conteudoTxt = "Erro ao carregar o conteúdo da notícia.";
    }
  }
 
  return (
    <div id="Corpo" className="body-next" style={{ display: 'flex', justifyContent: 'center', padding: '40px 10px' }}>
      <article
        style={{
          maxWidth: '800px',
          width: '100%',
          backgroundColor: '#fff',
          borderRadius: '12px',
          boxShadow: '0 8px 20px rgba(0,0,0,0.1)',
          padding: '30px',
          display: 'flex',
          flexDirection: 'column',
          gap: '25px',
          animation: 'fadeIn 0.5s', // <- Fade-in aplicado aqui
        }}
      >
        <h1 className="titulo-next" style={{ fontSize: '32px', textAlign: 'center', color: '#111' }}>
          {noticia.titulo}
        </h1>
 
        {noticia.subtitulo && <h2 style={{ textAlign:'center', color:'#666', fontSize:'20px' }}>{noticia.subtitulo}</h2>}
 
        <div style={{ textAlign: 'center', color: '#444', fontSize: '14px' }}>
          Publicado em {dataFormatada} por {noticia.autor || 'Autor desconhecido'}
        </div>
 
        {/* Texto com quebras e wrap garantidos */}
       <div style={{
          whiteSpace: 'pre-wrap',
          wordWrap: 'break-word',
          overflowWrap: 'break-word',
          lineHeight: 1.8,
          fontSize: '16px',
          color: '#111',
      }}>
        {/* Renderiza o conteúdo HTML com dangerouslySetInnerHTML */}
        <div dangerouslySetInnerHTML={{ __html: conteudoTxt }} />
      </div>

 
        {noticia.imagens && noticia.imagens.length > 0 && (
          <ul style={{ padding: 0 }}>
            {noticia.imagens.map((img, i) => (
              <li key={i} style={{ listStyle: 'none', marginBottom: '10px' }}>
                <img src={img} alt={`Imagem ${i+1}`} style={{ maxWidth: '100%', borderRadius: '8px' }} />
              </li>
            ))}
          </ul>
        )}
        <BackButton />
      </article>
    </div>
  );
}
 